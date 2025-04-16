// ServiceHub Custom Scripts

document.addEventListener("DOMContentLoaded", () => {
    // Chat Widget Functionality
    const chatButton = document.querySelector(".chat-button")
    const chatPopup = document.querySelector(".chat-popup")
    const closeChat = document.querySelector(".close-chat")
  
    if (chatButton && chatPopup && closeChat) {
      chatButton.addEventListener("click", () => {
        chatPopup.style.display = "flex"
        chatButton.style.display = "none"
      })
  
      closeChat.addEventListener("click", () => {
        chatPopup.style.display = "none"
        chatButton.style.display = "flex"
      })
    }
  
    // Scroll to Top Button
    const scrollToTopButton = document.getElementById("scrollToTop")
  
    if (scrollToTopButton) {
      window.addEventListener("scroll", () => {
        if (window.pageYOffset > 300) {
          scrollToTopButton.classList.add("visible")
        } else {
          scrollToTopButton.classList.remove("visible")
        }
      })
  
      scrollToTopButton.addEventListener("click", () => {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        })
      })
    }
  
    // Service Category Hover Effect
    const serviceCategories = document.querySelectorAll(".service-category-item")
  
    serviceCategories.forEach((category) => {
      category.addEventListener("mouseenter", function () {
        const icon = this.querySelector("i")
        icon.style.transform = "scale(1.2)"
      })
  
      category.addEventListener("mouseleave", function () {
        const icon = this.querySelector("i")
        icon.style.transform = "scale(1)"
      })
    })
  
    // Initialize location dropdown
    const locationSelect = document.querySelector(".location-selector select")
    if (locationSelect) {
      locationSelect.addEventListener("change", function () {
        // You can add functionality to update services based on location
        console.log("Location changed to: " + this.value)
      })
    }
  
    // Mobile responsive menu
    const mobileMenuToggle = document.querySelector(".navbar-toggler")
    if (mobileMenuToggle) {
      mobileMenuToggle.addEventListener("click", () => {
        const navbarCollapse = document.querySelector(".navbar-collapse")
        if (navbarCollapse) {
          navbarCollapse.classList.toggle("show")
        }
      })
    }
  
    // Service card hover effects
    const serviceCards = document.querySelectorAll(".service-card")
    serviceCards.forEach((card) => {
      card.addEventListener("mouseenter", function () {
        this.style.boxShadow = "0 10px 20px rgba(0, 0, 0, 0.1)"
      })
  
      card.addEventListener("mouseleave", function () {
        this.style.boxShadow = "0 2px 10px rgba(0, 0, 0, 0.1)"
      })
    })
  })
  