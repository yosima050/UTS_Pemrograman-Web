document.addEventListener("DOMContentLoaded", function() {
    const cards = [
        { id: "mountains-card", url: "https://unsplash.com/s/photos/mountains" },
        { id: "beach-card", url: "https://unsplash.com/s/photos/beach" },
        { id: "sunset-card", url: "https://unsplash.com/s/photos/sunset" },
        { id: "night-card", url: "https://unsplash.com/s/photos/night-sky" }
    ];

    cards.forEach(card => {
        const el = document.getElementById(card.id);
        if (el) {
            el.style.cursor = "pointer";
            el.addEventListener("click", function(e) {
                e.preventDefault();
                const proceed = confirm("You are about to leave PhotoStock and go to another website. Continue?");
                if (proceed) {
                    window.open(card.url, '_blank');
                }
            });
        }
    });
});