window.addEventListener("beforeinstallprompt", (event) => {
  // Prevent the default browser install prompt
  event.preventDefault();
  // Store the event for later use
  deferredInstallPrompt = event;
  // Show your custom install banner/button
  showInstallBanner();
});

function showInstallBanner() {
  // Show your custom install banner/button
  const installButton = document.getElementById("install-button");
  installButton.style.display = "block";
  // Add click event listener to trigger installation
  installButton.addEventListener("click", () => {
    deferredInstallPrompt.prompt();
    // Wait for the user's choice (accepted or dismissed)
    deferredInstallPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === "accepted") {
        // Installation successful
        console.log("PWA installation accepted");
      } else {
        // Installation canceled
        console.log("PWA installation dismissed");
      }
      // Clear the deferredInstallPrompt variable
      deferredInstallPrompt = null;
    });
  });
}


//ALERTS
$('#err').fadeOut(1000);