class CardNews extends HTMLElement {
    constructor() {
      super();
  
      const shadow = this.attachShadow({ mode: "open" });
      shadow.appendChild(this.build());
      shadow.appendChild(this.styles());
    }
  
    build() {
      const componentRoot = document.createElement("div");
      componentRoot.setAttribute("class", "cartao");
  
      const cartao_esquerdo = document.createElement("div");
      cartao_esquerdo.setAttribute("class", "cartao_esquerdo");
  
      const autor = document.createElement("span");
      autor.textContent = "By " + (this.getAttribute("autor") || "Anonymous");
  
      const titulo = document.createElement("h1");
      titulo.textContent = this.getAttribute("titulo");
      
      const titulo2 = document.createElement("h3");
      titulo2.textContent = this.getAttribute("titulo2");

      const linkTitle = document.createElement("a");
      linkTitle.textContent = this.getAttribute("title");
      linkTitle.href = this.getAttribute("link-url");
  
      
      cartao_esquerdo.appendChild(autor);
      cartao_esquerdo.appendChild(titulo);
      cartao_esquerdo.appendChild(titulo2);
      cartao_esquerdo.appendChild(linkTitle);
      
  
      const cartao_direito = document.createElement("div");
      cartao_direito.setAttribute("class", "cartao_direito");
  
      const novaImage = document.createElement("img");
      novaImage.src = this.getAttribute("foto") || "assets/imagens/evento_basquete.png";
      novaImage.alt = "Imagem do Evento";
      cartao_direito.appendChild(novaImage);
  
      componentRoot.appendChild(cartao_esquerdo);
      componentRoot.appendChild(cartao_direito);
  
      return componentRoot;
    }
  
    styles() {
      const style = document.createElement("style");
      style.textContent = `
      
      
      `;
  
      return style;
    }
  }
  
  customElements.define("cartao-novo", CardNews);