window.addEventListener('load', () => {
  document.querySelector('.add-achievement-button').addEventListener('click', () => {
    const achievementContainer = document.querySelector('.achievement-container');
    const achievementFieldsCount = achievementContainer.querySelectorAll('.achievement-field').length;
    const newChildElement = achievementContainer.children[achievementFieldsCount - 1].cloneNode(true);

    if (newChildElement.querySelector('.removable')) {
      newChildElement.querySelector('.removable').remove();
    }

    const textareaField = newChildElement.querySelector('textarea[name*="name"]');
    textareaField.name = `achievement[${achievementFieldsCount}][name]`;
    textareaField.value = '';

    const startDateField = newChildElement.querySelector('input[name*="startDate"]');
    startDateField.name = `achievement[${achievementFieldsCount}][startDate]`;
    startDateField.value = '';

    const endDatefield = newChildElement.querySelector('input[name*="endDate"]');
    endDatefield.name = `achievement[${achievementFieldsCount}][endDate]`;
    endDatefield.value = '';

    const deleteButton = document.createElement('span');
    deleteButton.textContent = 'x';
    deleteButton.classList.add('removable');
    deleteButton.title = 'Usuń osiągnięcie';

    deleteButton.addEventListener('click', (e) => {
      const node = e.target.parentNode;
      node.remove();
    });

    newChildElement.appendChild(deleteButton);
    achievementContainer.appendChild(newChildElement);
  });

  document.querySelector('input[type="submit"]').addEventListener('click', (e) => {
    document.querySelector('.loading-info').style.display = 'flex';
    e.target.style.display = 'none';
  });
});
