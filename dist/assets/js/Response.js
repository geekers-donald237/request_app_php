var remar = document.getElementById('remarque');
const selectElement = document.querySelector('.dec');

selectElement.addEventListener('change', (event) => {
  const result = document.querySelector('.result');
  result.textContent = `${event.target.value}`;

  var dd = result.textContent;
 
  if(dd !== "Je rejete la Requete"){
    remar.style.display = 'none';
  }else {
    remar.style.display = 'block';

  }
});
