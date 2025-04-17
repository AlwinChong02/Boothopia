document.addEventListener("DOMContentLoaded", function () {
    let toggles = document.getElementsByClassName("toggle-faq");
    let contents = document.getElementsByClassName("content-faq");
    let icons = document.getElementsByClassName("fa");

    for (let i = 0; i < toggles.length; i++) {
        toggles[i].addEventListener("click", function () {
            let content = contents[i];
            let icon = icons[i];
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                toggles[i].style.color = "#111130";
                icon.classList.remove("fa-minus");
                icon.classList.add("fa-plus");
            } else {
                for (let j = 0; j < contents.length; j++) {
                    contents[j].style.maxHeight = null;
                    toggles[j].style.color = "#111130";
                    icons[j].classList.remove("fa-minus");
                    icons[j].classList.add("fa-plus");
                }
                content.style.maxHeight = content.scrollHeight + "px";
                toggles[i].style.color = "#0084e9";
                icon.classList.remove("fa-plus");
                icon.classList.add("fa-minus");
            }
        });
    }
});

