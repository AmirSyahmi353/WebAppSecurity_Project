// public/js/fooddiary.js
(() => {
  console.info('[FD] loader starting');

  // helper to find element and warn if missing
  function $id(name) {
    const el = document.getElementById(name);
    if (!el) console.warn(`[FD] missing element #${name}`);
    return el;
  }

  // required DOM elements (may be top-level or inside modal)
  const saveItemBtn = $id('saveItem');
  const itemsTableBody = document.querySelector('#itemsTable tbody');
  const foodName = $id('food_name');
  const portion = $id('portion');
  const portionOther = $id('portion_other');
  const foodImage = $id('food_image');
  // time used in table row (modal has item_time, top-level has time)
  const itemTimeModal = $id('item_time');
  const topLevelTime = $id('time');
  const mealSelect = $id('meal');     // top-level meal selector
  const editingIndex = $id('editingIndex');
  const modalTitle = $id('modalTitle');
  const alertsEl = $id('alerts');

  // quick fail if table body or save button missing
  if (!itemsTableBody) {
    console.error('[FD] #itemsTable tbody not found — table cannot be updated');
    return;
  }
  if (!saveItemBtn) {
    console.error('[FD] #saveItem button not found — cannot save items');
    return;
  }

  // internal items array (client-side)
  const items = []; // each item: { food, portion, time, imageFile, imagePreviewUrl }

  // safe escape
  function esc(s = '') {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
  }

  // show small in-page alert (like you used)
  function showAlert(msg, type = 'info') {
    if (!alertsEl) {
      console.log('[FD] alert:', msg);
      return;
    }
    alertsEl.innerHTML = `<div class="alert alert-${type}">${msg}</div>`;
    setTimeout(()=> { alertsEl.innerHTML = ''; }, 3000);
  }

  // render table rows according to your blade columns: Food | Portion | Image | Time | Action
  function renderTable() {
    itemsTableBody.innerHTML = '';
    items.forEach((it, idx) => {
      const imgHtml = it.imagePreviewUrl
        ? `<img src="${it.imagePreviewUrl}" style="max-width:80px;max-height:60px;object-fit:cover;border-radius:6px;">`
        : '<span class="text-muted">No image</span>';

      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${esc(it.food)}</td>
        <td>${esc(it.portion)}</td>
        <td class="text-center">${imgHtml}</td>
        <td class="text-center">${esc(it.time || '')}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-secondary edit-item" data-idx="${idx}">Edit</button>
          <button class="btn btn-sm btn-danger delete-item" data-idx="${idx}">Delete</button>
        </td>
      `;
      itemsTableBody.appendChild(tr);
    });
  }

  // reset modal inputs
  function resetModal() {
    if (foodName) foodName.value = '';
    if (portion) portion.value = '';
    if (portionOther) { portionOther.value = ''; portionOther.classList.add('d-none'); }
    if (foodImage) foodImage.value = '';
    if (itemTimeModal) itemTimeModal.value = '';
    if (editingIndex) editingIndex.value = -1;
    if (modalTitle) modalTitle.textContent = 'Add Food Item';
  }

  // open edit modal for item
  function openEditModal(idx) {
    const it = items[idx];
    if (!it) return;
    if (mealSelect) mealSelect.value = it.meal || mealSelect.value || '';
    if (foodName) foodName.value = it.food || '';
    if (portion) {
      const found = Array.from(portion.options).some(o => o.value === it.portion);
      if (found) {
        portion.value = it.portion;
        if (portionOther) { portionOther.classList.add('d-none'); portionOther.value = ''; }
      } else {
        portion.value = 'Other';
        if (portionOther) { portionOther.classList.remove('d-none'); portionOther.value = it.portion; }
      }
    }
    if (itemTimeModal) itemTimeModal.value = it.time || '';
    if (foodImage) foodImage.value = ''; // cannot programmatically set file input
    if (editingIndex) editingIndex.value = idx;
    if (modalTitle) modalTitle.textContent = 'Edit Food Item';
    const modalEl = document.getElementById('addFoodModal');
    if (modalEl) new bootstrap.Modal(modalEl).show();
  }

  // event delegation for table buttons
  itemsTableBody.addEventListener('click', (e) => {
    const t = e.target;
    if (t.matches('.edit-item')) {
      const idx = parseInt(t.dataset.idx, 10);
      openEditModal(idx);
      return;
    }
    if (t.matches('.delete-item')) {
      const idx = parseInt(t.dataset.idx, 10);
      if (confirm('Remove this item?')) {
        items.splice(idx, 1);
        renderTable();
      }
      return;
    }
  });

  // Save Item click handler
  saveItemBtn.addEventListener('click', () => {
    try {
      // read inputs (modal fields)
      const food = (foodName && foodName.value || '').trim();
      let part = (portion && portion.value) || '';
      if (part === 'Other' && portionOther) part = (portionOther.value || '').trim();
      const timeVal = (itemTimeModal && itemTimeModal.value) || (topLevelTime && topLevelTime.value) || '';
      const mealVal = (mealSelect && mealSelect.value) || '';
      // file
      const file = (foodImage && foodImage.files && foodImage.files[0]) || null;
      const previewUrl = file ? URL.createObjectURL(file) : null;

      if (!food) { alert('Please enter food name.'); return; }
      if (!part) { alert('Please select/describe portion.'); return; }
      if (!timeVal) { alert('Please provide time.'); return; }
      if (!mealVal) { alert('Please choose meal (Breakfast/Lunch/etc)'); return; }

      const idx = (editingIndex && parseInt(editingIndex.value, 10)) || -1;

      const newItem = { meal: mealVal, food, portion: part, time: timeVal, imageFile: file, imagePreviewUrl: previewUrl };

      if (idx >= 0 && Number.isInteger(idx)) {
        items[idx] = newItem;
        console.info('[FD] edited item', idx, newItem);
      } else {
        items.push(newItem);
        console.info('[FD] pushed item', newItem);
      }

      renderTable();
      resetModal();

      // hide modal if present
      const modalEl = document.getElementById('addFoodModal');
      if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.hide();
      }

    } catch (err) {
      console.error('[FD] saveItem error', err);
      alert('Unexpected error while adding item. See console.');
    }
  });

  // enable Edit/Delete if server-side rows were present we disabled earlier; now user can add new items
  console.info('[FD] ready — attach saveItem handler');

})();
