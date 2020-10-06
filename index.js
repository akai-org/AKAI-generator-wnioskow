createAchievements = (data) => {
  const achievementContainer = document.querySelector('.achievement-container');

  data.forEach((dataElement) => {
    const achievementFieldsCount = achievementContainer.querySelectorAll('.achievement-field').length;
    const newChildElement = achievementContainer.children[achievementFieldsCount - 1].cloneNode(true);

    if (newChildElement.querySelector('.removable')) {
      newChildElement.querySelector('.removable').remove();
    }

    const textareaField = newChildElement.querySelector('textarea[name*="name"]');
    textareaField.name = `achievement[${achievementFieldsCount}][name]`;
    textareaField.value = dataElement.value;

    const startDateField = newChildElement.querySelector('input[name*="startDate"]');
    startDateField.name = `achievement[${achievementFieldsCount}][startDate]`;
    startDateField.value = dataElement.startDate;

    const endDatefield = newChildElement.querySelector('input[name*="endDate"]');
    endDatefield.name = `achievement[${achievementFieldsCount}][endDate]`;
    endDatefield.value = dataElement.endDate;

    const deleteButton = document.createElement('span');
    deleteButton.textContent = 'x';
    deleteButton.classList.add('removable');
    deleteButton.title = 'Usuń osiągnięcie';

    deleteButton.addEventListener('click', (e) => {
      const node = e.target.parentNode;
      node.remove();
      sendAchievementCookie();
    });

    newChildElement.appendChild(deleteButton);
    achievementContainer.appendChild(newChildElement);
  });

  const fields = document.querySelectorAll('.achievement-field');
  fields[1].querySelector('.removable').remove();
  fields[0].remove();
};

const loadData = () => {
  const data = document.cookie.split('; ').map((element) => {
    return element.split('=');
  });

  const achievements = data.find((element) => element[0] === 'achievements');
  // console.log(achievements[1]);
  const achievementsData = achievements ? JSON.parse(achievements[1]) : null;

  if (achievementsData) createAchievements(achievementsData);

  const form = document.querySelector('form');
  const inputs = form.querySelectorAll('label input');

  const semesters = document.querySelector('.semesters').querySelectorAll('input');
  const semestersValues = [];

  inputs.forEach((input) => {
    data.forEach((dataElement) => {
      if (input.name === dataElement[0]) input.value = dataElement[1];
      if (dataElement[0].startsWith('semester')) if (semestersValues.length < 2) semestersValues.push(dataElement[1]);
    });
  });

  if (semestersValues[0]) semesters[0].value = semestersValues[0];
  if (semestersValues[1]) semesters[1].value = semestersValues[1];
};

window.addEventListener('load', () => {
  loadData();
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
      sendAchievementCookie();
    });

    newChildElement.appendChild(deleteButton);
    achievementContainer.appendChild(newChildElement);
  });

  document.querySelector('input[type="submit"]').addEventListener('click', (e) => {
    document.querySelector('.loading-info').style.display = 'flex';
    e.target.style.display = 'none';
  });

  document.querySelector('form').addEventListener('submit', (e) => {
    const inputs = e.target.querySelectorAll('label input');

    let counter = 1;

    inputs.forEach((input) => {
      if (input.value !== '') {
        if (input.name === 'semester[]') {
          document.cookie = `${input.name}${counter}=${input.value}`;
          counter++;
        } else document.cookie = `${input.name}=${input.value}`;
      }
    });

    sendAchievementCookie();
  });
});

const sendAchievementCookie = () => {
  const achievementElements = document.querySelector('form').querySelectorAll('.achievement-field');
  let achievements = [];

  achievementElements.forEach((achievement) => {
    const value = achievement.querySelector('.wideField').value;
    const startDate = achievement.querySelector('.startDate').value;
    const endDate = achievement.querySelector('.endDate').value;

    let achie = {
      value,
      startDate,
      endDate,
    };

    achievements.push(achie);
  });

  document.cookie = 'achievements=' + JSON.stringify(achievements);
};
