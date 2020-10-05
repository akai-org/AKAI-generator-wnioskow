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

  document.querySelector('#link').addEventListener('click', () => {
      const query = {
          leader: document.querySelector('#leader').value,
          clubname: document.querySelector('#clubname').value,
          department: document.querySelector('#department').value,
          patron: document.querySelector('#patron').value
      };

      const queryString = getQuerStringFromObject(query);
      const link = generateLinkWithParamsString(queryString);
      copyTextToClipboard(link);
   });
    
  document.querySelector('input[type="submit"]').addEventListener('click', (e) => {
    document.querySelector('.loading-info').style.display = 'flex';
    e.target.style.display = 'none';
  });
});

function getQuerStringFromObject(object) {
    return Object.entries(object)
        .map(pair => pair.map(encodeURIComponent).join('='))
        .join('&');
}

function generateLinkWithParamsString(string) {
    const baseLink = window.location.href.split('?')[0];
    return baseLink + "?" + string;
}

function copyTextToClipboard(text) {
    let textarea = document.createElement("textarea");

    textarea.style.position = 'fixed';
    textarea.style.top = 0;
    textarea.style.left = 0;
    textarea.style.width = '2em';
    textarea.style.height = '2em';
    textarea.style.padding = 0;
    textarea.style.border = 'none';
    textarea.style.outline = 'none';
    textarea.style.boxShadow = 'none';
    textarea.style.background = 'transparent';

    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.focus();
    textarea.select();

    const successful = document.execCommand('copy');

    if(successful) {
      console.log("Pomyślnie skopiowano link");
    } else {
      console.error("Kopiowanie nie powiodło się. Zgłoś ten błąd na GitHubie abyśmy mogli się nim zająć!");
    }

    document.body.removeChild(textarea);
}