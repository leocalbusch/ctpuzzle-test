var TelaEscolha = function () {
  this.menino = new Image();
  this.menino = tdsImagens[8];
  this.menina = new Image();
  this.menina = tdsImagens[9];
  this.fundo = new Image();
  this.fundo = tdsImagens[10];
  this.showMenino = false;
  this.showMenina = false;
  this.ativo = true;
};
TelaEscolha.prototype.Draw = function () {
  context.drawImage(this.fundo, 0, 0);
  context.font = "40px Georgia";
  context.fillText("Escolha seu personagem:", 150, 70);
  if (this.showMenino) {
    context.drawImage(this.menino, 16, 137);
  } else if (this.showMenina) {
    context.drawImage(this.menina, 486, 150);
  }
}
TelaEscolha.prototype.MouseMove = function (mouseEvent) {
  //Realce ao clicar sobre o personagem
  if (posMouseX > 16 && posMouseX < 411 && posMouseY > 137) {
    this.showMenino = true;
    this.showMenina = false;
  } else if (posMouseX > 486 && posMouseX < 784 && posMouseY > 150) {
    this.showMenino = false;
    this.showMenina = true;
  } else {
    this.showMenino = false;
    this.showMenina = false;
  }
}
TelaEscolha.prototype.MouseUp = function (mouseEvent) {
  // Seleção do personagem (bug: permite clicar sobre um, arrastar até o outro
  // e selecionar o que não está realçado pois o que conta é o MouseUp
  if (posMouseX > 16 && posMouseX < 411 && posMouseY > 137) {
    genero = 1;
    //desativa essa tela pra liberar o main pra ir pra próxima tela
    this.ativo = false;
  } else if (posMouseX > 486 && posMouseX < 784 && posMouseY > 150) {
    genero = 0;
    this.ativo = false;
  }
  //independente de ter escolhido ou não, tira o realce
  this.showMenino = false;
  this.showMenina = false;
}
TelaEscolha.prototype.KeyDown = function (keyCode) { }
