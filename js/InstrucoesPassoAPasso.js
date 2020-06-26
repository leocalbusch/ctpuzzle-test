var instrucoes = {
  programacao: [
    { text: 'Olá,\nPreciso chegar na parte laranja\ndo mapa. Pode me ajudar?', x: 370, y: 85 },
    { text: 'Aqui ficam os comandos que\nvocê pode utilizar', x: 370, y: 90 },
    { text: 'Você pode arrastá-los para \no PROGRAMA e montar \no caminho', x: 370, y: 85 },
    { text: 'Clicando aqui, eu começo andar', x: 370, y: 95 },
    { text: 'E clicando aqui, o caminho é \nzerado', x: 370, y: 95 },
  ]
}

var InstrucoesPassoAPasso = function (canvasContext, personagem) {
  let self = this;
  self.rootImagesPath = 'img/Instrucoes/guias/';
  self.indiceInstrucaoAtual = 0;
  self.canvasContext = canvasContext;
  self.personagem = personagem;
  self.onFinishSteps = function () { console.log('not implemented ') }

  self.buildImageName = function (index) {
    return self.rootImagesPath + self.faseAtual + "/frame000" + index + ".png"
  }
  self.finishedInstrucionsSteps = function () {
    const instrucoesFase = instrucoes[self.faseAtual];
    return !instrucoesFase || self.indiceInstrucaoAtual >= instrucoesFase.length;
  }

  /**
  * Desenha a ajuda utilizando o nome da fase e o índice do passo atual para carregar a imagem
  */
  self.desenhaInstrucao = function (nomeFase, falando) {
    if (nomeFase) {
      if (nomeFase !== self.faseAtual) {
        self.zeraInstrucoes();
      }
      self.faseAtual = nomeFase;
      if (self.finishedInstrucionsSteps()) {
        self.onFinishSteps();
      } else {
        const imagePath = self.buildImageName(self.indiceInstrucaoAtual);
        loadImage(imagePath, {
          onLoad: function (image) {
            self.canvasContext.drawImage(image, 0, 0);
          },
          onError: function () {
            console.log('Imagem ' + imagePath + ' não carregada.')
          }
        }
        );
        self._desenhaPersonagem(self.faseAtual, falando);
      }
    }
  }

  self._desenhaPersonagem = function (nomeFase, falando) {
    const instrucaoFase = instrucoes[nomeFase];
    if (instrucaoFase) {
      let instrucao = instrucaoFase[self.indiceInstrucaoAtual];
      if (instrucao) {
        let textoFala = instrucao.text
        let sprite = self.personagem.spriteTalk;
        let framePath = sprite.images[falando ? 0 : 1]
        self.canvasContext.fillStyle = "black";
        self.canvasContext.font = "13pt Arial"
        printAtWordWrap(self.canvasContext, textoFala, instrucao.x, instrucao.y, 18)
        loadImage(framePath, {
          onLoad: function (image) {
            self.canvasContext.drawImage(image, sprite.x, sprite.y);
          }
        })
      }
    }
  }

  self.zeraInstrucoes = function () {
    self.indiceInstrucaoAtual = 0;
  }

  self.avancaInstrucao = function () {
    self.indiceInstrucaoAtual++;
  }

  self.voltaInstrucao = function () {
    self.indiceInstrucaoAtual--;
  }

  return self;
}
