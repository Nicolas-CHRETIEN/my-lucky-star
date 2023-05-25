// const addImageButton = document.querySelector(".addImage");
// const firstAddImageForm = document.querySelector(".firstAddImageForm");
// const formToAdd = document.querySelector("#create_star_otherImages");
// const formModel = formToAdd.innerHTML;
// console.log(formToAdd);
// console.log("form model: " + formModel);
// let imageFormComptor = 0;

// addImageButton.addEventListener("click", addImage);


// function addImage () {
//     if (formToAdd.classList.contains("visually-hidden")) {

//         // remove the hidden class so that the form becomes visible:
//         formToAdd.classList.remove("visually-hidden");

//         // Increase the comptor and create a unique class for the form:
//         imageFormComptor++;
//         formToAdd.classList.add("form-" + imageFormComptor);

//         // Create a remove button to delete the created form:
//         const deleteFormAddImage = document.createElement("button");
//         deleteFormAddImage.innerHTML = "X"
//         deleteFormAddImage.addEventListener("click", (function () {
//             firstAddImageForm.remove();
//         }));
//         formToAdd.appendChild(deleteFormAddImage);

//     } else {

        

//         // Increase the comptor and create a unique class for the form:
//         imageFormComptor++;

//         // Add a new field for each click:
//         const newImageForm = document.createElement("div");

//         // Insert the code in a div to transform it into html:
//         newImageForm.innerHTML = formModel;

//         // Add a unique class to the form:
//         newImageForm.classList.add("form-" + imageFormComptor);

//         // Create a remove button to delete the created form:
//         const deleteButtonFormAddImage = document.createElement("button");
//         deleteButtonFormAddImage.innerHTML = "X";
//         deleteButtonFormAddImage.addEventListener("click", (function () {
//             newImageForm.remove();
//         }));
//         newImageForm.appendChild(deleteButtonFormAddImage);

//         // Add the form to the html code:
//         formToAdd.appendChild(newImageForm);
//     }
// };

// // function to delete the form:
// function deleteForm (form) {
//     form.remove();
// }





$(".addImage").click(function () {
    const index = +$("#widget-count").val();
    const formToAdd = $("#create_star_otherImages").data("prototype").replace(/__name__/g, index);
    $("#create_star_otherImages").append(formToAdd);
    $("#widget-count").val(index + 1);
    deleteButton();

});


function updateCounter () {
    const count = +$("#create_star_otherImages div.form-group").length;
    $("#widget-count").val(count);
}




function deleteButton () {
    $("button[data-action = 'delete']").click(function(){
        const target = this.dataset.target;
        $(target).remove();
    });
}

updateCounter();
deleteButton();