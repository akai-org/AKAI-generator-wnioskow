export const removeAchievement = (e) => {
  e.preventDefault();

  e.target.parentNode.remove();

  const achievements = Array.from(document.querySelectorAll('.achievement-field'));

  achievements.map((achievement, index) => {
    achievement.name = `achievement[${index}]`;
    achievement.querySelector('textarea').name = `achievement[${index}]`;
    achievement.querySelector('textarea').dataset.name = `achievement[${index}]`;
  });
};
