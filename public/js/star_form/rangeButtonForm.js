let slider = document.querySelector(".indicatedRange");
let output = document.querySelector(".rangeValue");

let rangeValue = function(){
    let newValue = slider.value;
    output.innerHTML = newValue;
  }

  slider.addEventListener("input", rangeValue);