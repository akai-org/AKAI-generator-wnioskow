window.addEventListener('load', () => {
  document.querySelector('.add-achievement-button').addEventListener('click', () => {
    const achievementContainer = document.querySelector('.achievement-container');
    const achievementFieldsCount = achievementContainer.querySelectorAll('.achievement-field').length;
    const newChildElement = achievementContainer.children[achievementFieldsCount - 1].cloneNode(true);

    console.log(newChildElement.querySelector('textarea[name*="name"]').name);

    newChildElement.querySelector('textarea[name*="name"]').name = `achievement[${achievementFieldsCount}][name]`;
    newChildElement.querySelector(
      'input[name*="startDate"]'
    ).name = `achievement[${achievementFieldsCount}][startDate]`;
    newChildElement.querySelector('input[name*="endDate"]').name = `achievement[${achievementFieldsCount}][endDate]`;

    achievementContainer.appendChild(newChildElement);
  });
});
