// Password Verification -----

$(document).ready(function() {

    // client side validation
    $("#sign-up").validate({
        errorClass: 'error-text', 
        rules: {
            email: {
                required: true,
                email: true,
                maxlength: 320
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 255
            },
            password_confirm: {
                required: true,
                minlength: 6,
                maxlength: 255,
                equalTo: '[name="password"]'
            }
        },
        messages: {
            password_confirm: 'Passwords must match.',
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

});


// Search function --- 

const searchForm = document.querySelector("#search-form");

searchForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const searchInput = searchForm.querySelector('input');
    const searchQueries = searchInput.value.toLowerCase().trim();
    const noteTitles = document.querySelectorAll(".note-title");
    const error = document.querySelector("#error-msg");

    // store NodeLists as Array
    const articles = Array.from(document.querySelectorAll("article"));
    const searchQuery = Array.from(searchQueries.split(' '));
    const titleValues = Array.from(noteTitles).map((title) => (title.innerText.toLowerCase().split(' ')));

    let foundMatch = false;

    articles.forEach((article, index) => {
        if (titleValues[index].some((word) => searchQuery.includes(word))) {
            article.style.display = "block";
            foundMatch = true;
        } else {
            article.style.display = "none";
        }
    });

    // Display error block if no match is found
    if (!foundMatch) {
        error.style.display = "block";
    } else {
        error.style.display = "none";
    };

    searchInput.value = "";

});


// Tabs -----
