const sidebar = document.getElementById("mySidebar");
const popup = document.getElementById("accountPopup");
const overlay = document.getElementById("overlay");

function toggleSidebar() {
    sidebar.classList.toggle("show");
}

function showAccountInfo() {
    const userInfo = JSON.parse(localStorage.getItem("userInfo"));

    if (!userInfo) {
        alert("Please login first!");
        window.location.href = "register.php"; // redirect if not logged in
        return;
    }

    document.getElementById("accName").innerText = userInfo.name;
    document.getElementById("accAddress").innerText = userInfo.address;
    document.getElementById("accPhone").innerText = userInfo.phone;
    document.getElementById("accEmail").innerText = userInfo.email;

    popup.classList.add("show");
    overlay.classList.add("show");
}

function closePopup() {
    popup.classList.remove("show");
    overlay.classList.remove("show");
}



function saveUser(e) {
    e.preventDefault();
    const userInfo = {
        name: document.getElementById("name").value,
        address: document.getElementById("address").value,
        phone: document.getElementById("phone").value,
        email: document.getElementById("email").value
    };
    localStorage.setItem("userInfo", JSON.stringify(userInfo));
    alert("Login successful!");
    window.location.href = "index.html";
}









      function addToCart(name, price, image) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
       /* const exists = cart.find(p => p.name === name);
        if (!exists) {*/
        const alreadyAdded = cart.find(p => p.name === name);
      if (alreadyAdded) {
        alert(`${name} is already in the cart.`);
      } else {
          cart.push({ name, price, image });
          localStorage.setItem('cart', JSON.stringify(cart));
        }
        window.location.href = 'art.html';
      }

  
  


  document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const message = document.getElementById("message").value;
  
    alert('Thank you, Your message has been sent.');
    this.reset();
    
     
    
    app.get('/dashboard', (req, res) => {
    if (req.session.user) {
      res.json({ username: req.session.user.username });
    } else {
      res.redirect('/login');
    }
  });
});
    
