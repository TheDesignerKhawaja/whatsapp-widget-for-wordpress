document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        var whatsappLink = document.getElementById("whatsapp-link");
        var siteName = window.location.hostname.replace('.', ' .');
        var pageTitle = document.querySelector("h1").textContent || document.title; // Defaults to page title if h1 is not found
        
        var message = `I just visited ${siteName} and would like to know more about *${pageTitle}*. Looking forward to your expert advice!`;
        var encodedMessage = encodeURIComponent(message); // Encode the message for the URL
        
        var currentHref = whatsappLink.getAttribute("href");
        var updatedHref = currentHref + encodedMessage; // Add the message to the URL
        
        whatsappLink.setAttribute("href", updatedHref); // Update the link with the message
        
        const whatsappChatBox = document.getElementById("whtasapp-chat-box");
        const toggleWhatsappBtns = document.querySelectorAll(".toggle-whatsapp-btn");
        let isChatBoxOpen = false;

        const toggleWhatsappChatBox = () => {
            if (!isChatBoxOpen) {
                whatsappChatBox.classList.add("displayed-chat");
            } else {
                whatsappChatBox.classList.remove("displayed-chat");
            }

            isChatBoxOpen = !isChatBoxOpen;
        }

        toggleWhatsappBtns.forEach(btn => {
            btn.addEventListener("click", toggleWhatsappChatBox);
        });

        setTimeout(() => toggleWhatsappBtns[1].classList.add("message-indicated"), 4000); // Display Message Indication icon after 7 seconds of page load 

        setTimeout(() => whatsappChatBox.classList.add("displayed-chat"), 6000); // Display Chatbox after 8 seconds

    }, 500); // Delay to avoid render-blocking
});