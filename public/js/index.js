const radio0 = document.getElementById('radio0');
const radio1 = document.getElementById('radio1');
const radio2 = document.getElementById('radio2');
const radio3 = document.getElementById('radio3');
const radio4 = document.getElementById('radio4');
const radio5 = document.getElementById('radio5');
const arm = document.getElementsByClassName('arm');
const chest = document.getElementsByClassName('chest');
const back = document.getElementsByClassName('back');
const abu = document.getElementsByClassName('abu');
const legs = document.getElementsByClassName('legs');

radio0.addEventListener('change', () => {
  console.log(arm.closest('.tr'))
  for (let i = 0; i < arm.length; i++) {
    const armParent = arm[i].closest('.tr');
    armParent.style.display = "";
  }
  for (let i = 0; i < chest.length; i++) {
    const chestParent = chest[i].closest('.tr');
    console.log(chestParent);
    chestParent.style.display = "";
  }
  for (let i = 0; i < back.length; i++) {
    const backParent = back[i].closest('.tr');
    backParent.style.display = "";
  }
  for (let i = 0; i < abu.length; i++) {
    const abuParent = abu[i].closest('.tr');
    abuParent.style.display = "";
  }
  for (let i = 0; i < legs.length; i++) {
    const legsParent = legs[i].closest('.tr');
    legsParent.style.display = "";
  }
})

radio1.addEventListener('change', () => {
  for (let i = 0; i < arm.length; i++) {
    const armParent = arm[i].closest('.tr');
    console.log(armParent)
    armParent.style.display = "";
  }
  for (let i = 0; i < chest.length; i++) {
    const chestParent = chest[i].closest('.tr');
    chestParent.style.display = "none";
  }
  for (let i = 0; i < back.length; i++) {
    const backParent = back[i].closest('.tr');
    backParent.style.display = "none";
  }
  for (let i = 0; i < abu.length; i++) {
    const abuParent = abu[i].closest('.tr');
    abuParent.style.display = "none";
  }
  for (let i = 0; i < legs.length; i++) {
    const legsParent = legs[i].closest('.tr');
    legsParent.style.display = "none";
  }
})
radio2.addEventListener('change', () => {
  for (let i = 0; i < arm.length; i++) {
    const armParent = arm[i].closest('.tr');
    armParent.style.display = "none";
  }
  for (let i = 0; i < chest.length; i++) {
    const chestParent = chest[i].closest('.tr');
    chestParent.style.display = "";
  }
  for (let i = 0; i < back.length; i++) {
    const backParent = back[i].closest('.tr');
    backParent.style.display = "none";
  }
  for (let i = 0; i < abu.length; i++) {
    const abuParent = abu[i].closest('.tr');
    abuParent.style.display = "none";
  }
  for (let i = 0; i < legs.length; i++) {
    const legsParent = legs[i].closest('.tr');
    legsParent.style.display = "none";
  }
})