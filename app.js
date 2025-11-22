const products = [
  { id: 1, name: "Sac à main", price: 150.99, desc: "c'est l'élegence qui parle.", img: "images/sac1.jpg" },
  { id: 2, name: "Sac à main", price: 99.99, desc: "Élégant et durable.", img: "images/sac2.jpg" },
  { id: 3, name: "Sac à main", price: 129.99, desc: "Pièce unique au charme discret, symbole de finesse et de modernité.", img: "images/sac3.jpg" },
    { id: 4, name: "Sac à main", price: 85.99, desc: "Sac rouge chic et intemporel, alliant style moderne et touche de sophistication.", img: "images/sac4.jpg" },
    { id: 5, name: "Sac à main", price: 159.99, desc: "Accessoire lumineux au ton chaleureux, parfait pour égayer vos tenues..", img: "images/sac5.jpg" },
     { id: 6, name: "Sac à main", price: 129.99, desc: "Sac moderne et chic, pensé pour les femmes dynamiques.", img: "images/sac6.jpg" },
      { id: 7, name: "Sac à main", price: 100.99, desc: "Sac marron élégant et polyvalent, conçu pour accompagner vos sorties de tous les jours.", img: "images/sac7.jpg" },
       { id: 8, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac8.jpg" },
        { id: 9, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac9.jpg" },
         { id: 10, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac10.jpg" },
          { id: 11, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac11.jpg" },
           { id: 12, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac12.jpg" },
            { id: 13, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac13.jpg" },
             { id: 14, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac14.jpg" },
              { id: 15, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac15.jpg" },
               { id: 16, name: "Sac de voyage", price: 129.99, desc: "Grand format, idéal pour voyager.", img: "images/sac16.jpg" },
];

let cart = [];

const productsGrid = document.getElementById("productsGrid");
const template = document.getElementById("productCardTemplate");
const cartPanel = document.getElementById("cartPanel");
const cartItems = document.getElementById("cartItems");
const cartCountEl = document.getElementById("cartCount");
const cartTotalEl = document.getElementById("cartTotal");
const cartToggle = document.getElementById("cartToggle");
const cartClose = document.getElementById("cartClose");
const checkoutBtn = document.getElementById("checkoutBtn");

function displayProducts(){
  productsGrid.innerHTML = "";
  products.forEach(p => {
    const clone = template.content.cloneNode(true);
    clone.querySelector(".card-image").src = p.img;
    clone.querySelector(".card-title").textContent = p.name;
    clone.querySelector(".card-desc").textContent = p.desc;
    clone.querySelector(".price").textContent = p.price.toFixed(2) + " TND";
    clone.querySelector(".add-btn").addEventListener("click", ()=> addToCart(p.id));
    productsGrid.appendChild(clone);
  });
}

function addToCart(id){
  const prod = products.find(p=>p.id===id);
  const found = cart.find(i=>i.id===id);
  if(found) found.qty++;
  else cart.push({ id: prod.id, name: prod.name, price: prod.price, qty: 1 });
  updateCart();
  openCart();
}

function updateCart(){
  cartItems.innerHTML = "";
  let total = 0;
  cart.forEach(item=>{
    total += item.price * item.qty;
    const div = document.createElement("div");
    div.className = "cart-item";
    div.innerHTML = `
      <div class="ci-left">
        <strong>${item.name}</strong>
        <div class="ci-qty">Quantité: ${item.qty}</div>
      </div>
      <div class="ci-right">
        <div>${(item.price*item.qty).toFixed(2)} TND</div>
        <div class="ci-actions">
          <button class="small" data-action="minus" data-id="${item.id}">-</button>
          <button class="small" data-action="plus" data-id="${item.id}">+</button>
          <button class="small" data-action="remove" data-id="${item.id}">suppr</button>
        </div>
      </div>
    `;
    cartItems.appendChild(div);
  });
  cartCountEl.textContent = cart.reduce((s,i)=>s+i.qty,0);
  cartTotalEl.textContent = total.toFixed(2) + " TND";
}

cartItems.addEventListener("click", e=>{
  const btn = e.target.closest("button");
  if(!btn) return;
  const action = btn.dataset.action;
  const id = parseInt(btn.dataset.id);
  if(action === "plus") cart.find(i=>i.id===id).qty++;
  else if(action === "minus"){
    const it = cart.find(i=>i.id===id);
    it.qty--; if(it.qty<=0) cart = cart.filter(x=>x.id!==id);
  }
  else if(action === "remove") cart = cart.filter(x=>x.id!==id);
  updateCart();
});

function openCart(){ cartPanel.setAttribute("aria-hidden","false"); }
function closeCart(){ cartPanel.setAttribute("aria-hidden","true"); }

cartToggle.addEventListener("click", ()=> openCart());
cartClose.addEventListener("click", ()=> closeCart());
checkoutBtn.addEventListener("click", ()=>{
  if(cart.length===0){ alert("Panier vide"); return; }
  alert("Paiement simulé — merci pour votre commande !");
  cart = [];
  updateCart();
  closeCart();
});

displayProducts();
updateCart();
document.getElementById("year").textContent = new Date().getFullYear();
