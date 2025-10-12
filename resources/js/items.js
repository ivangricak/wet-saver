//COPY LINK FUNCTION
export function SaveLink() {
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("copy")) {
            let btn = e.target;
            let link = btn.getAttribute("data-link");

            navigator.clipboard.writeText(link).then(() => {
                let originalText = btn.textContent;
                btn.textContent = "Done";

                setTimeout(() => {
                    btn.textContent = originalText;
                }, 1000);
            });
        }
    });
}



