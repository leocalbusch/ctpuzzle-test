let instrucoesPassoAPasso;
let faseAtual;

// Tentativa de deixar mais claro o nome das fases
// Não usando índice. Usando nomes
let fases = {
  1: 'programacao',
  //Aqui são as instruções passo a passo pro loop da quinta fase de programação
  155: 'programacao_loop',
  //Aqui são as instruções passo sobre as fases que tem mais de um objetivo
  156: 'programacao_objetivos',
  //...
}

let personagensMap = {
  0: {//menina
    spriteTalk: {
      x: 590,
      y: 125,
      images: [
        'img/Instrucoes/guias/girl0000.png',
        'img/Instrucoes/guias/girl0001.png'
      ]
    }
  },
  1: {//menino
    spriteTalk: {
      x: 590,
      y: 135,
      images: [
        'img/Instrucoes/guias/boy0000.png',
        'img/Instrucoes/guias/boy0001.png'
      ]
    }
  },
}

var Instrucoes = function (indice) {
  let self = this;

  this.indice = indice;

  let nomeGenero = genero == 0 ? 'girl' : 'boy';
  faseAtual = fases[indice];

  if (this.indice == 1 || this.indice == 155 || this.indice == 156) {
    let personagem = personagensMap[genero];
    instrucoesPassoAPasso = new InstrucoesPassoAPasso(context, personagem);
    instrucoesPassoAPasso.onFinishSteps = function () {
      self.ativo = false;
    }
    // mesma imagem pros dois casos (boca fechada e aberta)
    this.fundoBocaAberta = tdsImagens[faseAtual + '_' + nomeGenero];
    this.fundoBocaFechada = tdsImagens[faseAtual + '_' + nomeGenero];
  }

  if (genero == 0) {
    if (this.indice == 2) {
      this.fundoBocaAberta = tdsImagens[13];
      this.fundoBocaFechada = tdsImagens[14];
    } else if (this.indice == 3) {
      this.fundoBocaAberta = tdsImagens[15];
      this.fundoBocaFechada = tdsImagens[16];
    } else if (this.indice == 4) {
      this.fundoBocaAberta = tdsImagens[17];
      this.fundoBocaFechada = tdsImagens[18];
    } else if (this.indice == 5) {
      this.fundoBocaAberta = tdsImagens[19];
      this.fundoBocaFechada = tdsImagens[20];
    } else if (this.indice == 6) {
      this.fundoBocaAberta = tdsImagens[21];
      this.fundoBocaFechada = tdsImagens[22];
    } else if (this.indice == 7) {
      this.fundoBocaAberta = tdsImagens[23];
      this.fundoBocaFechada = tdsImagens[24];
    } else if (this.indice == 8) {
      this.fundoBocaAberta = tdsImagens[25];
      this.fundoBocaFechada = tdsImagens[26];
    } else if (this.indice == 9) {
      this.fundoBocaAberta = tdsImagens[27];
      this.fundoBocaFechada = tdsImagens[28];
    } else if (this.indice == 10) {
      this.fundoBocaAberta = tdsImagens[29];
      this.fundoBocaFechada = tdsImagens[30];
    } else if (this.indice == 11) {
      this.fundoBocaAberta = tdsImagens[31];
      this.fundoBocaFechada = tdsImagens[32];
    } else if (this.indice == 12) {
      this.fundoBocaAberta = tdsImagens[33];
      this.fundoBocaFechada = tdsImagens[34];
    } else if (this.indice == 13) {
      this.fundoBocaAberta = tdsImagens[35];
      this.fundoBocaFechada = tdsImagens[36];
    } else if (this.indice == 14) {
      this.fundoBocaAberta = tdsImagens[37];
      this.fundoBocaFechada = tdsImagens[38];
    } else if (this.indice == 15) {
      this.fundoBocaAberta = tdsImagens[39];
      this.fundoBocaFechada = tdsImagens[40];
    } else if (this.indice == 16) {
      this.fundoBocaAberta = tdsImagens[41];
      this.fundoBocaFechada = tdsImagens[42];
    }
  } else {
    if (this.indice == 2) {
      this.fundoBocaAberta = tdsImagens[45];
      this.fundoBocaFechada = tdsImagens[46];
    } else if (this.indice == 3) {
      this.fundoBocaAberta = tdsImagens[47];
      this.fundoBocaFechada = tdsImagens[48];
    } else if (this.indice == 4) {
      this.fundoBocaAberta = tdsImagens[49];
      this.fundoBocaFechada = tdsImagens[50];
    } else if (this.indice == 5) {
      this.fundoBocaAberta = tdsImagens[51];
      this.fundoBocaFechada = tdsImagens[52];
    } else if (this.indice == 6) {
      this.fundoBocaAberta = tdsImagens[53];
      this.fundoBocaFechada = tdsImagens[54];
    } else if (this.indice == 7) {
      this.fundoBocaAberta = tdsImagens[55];
      this.fundoBocaFechada = tdsImagens[56];
    } else if (this.indice == 8) {
      this.fundoBocaAberta = tdsImagens[57];
      this.fundoBocaFechada = tdsImagens[58];
    } else if (this.indice == 9) {
      this.fundoBocaAberta = tdsImagens[59];
      this.fundoBocaFechada = tdsImagens[60];
    } else if (this.indice == 10) {
      this.fundoBocaAberta = tdsImagens[61];
      this.fundoBocaFechada = tdsImagens[62];
    } else if (this.indice == 11) {
      this.fundoBocaAberta = tdsImagens[63];
      this.fundoBocaFechada = tdsImagens[64];
    } else if (this.indice == 12) {
      this.fundoBocaAberta = tdsImagens[65];
      this.fundoBocaFechada = tdsImagens[66];
    } else if (this.indice == 13) {
      this.fundoBocaAberta = tdsImagens[67];
      this.fundoBocaFechada = tdsImagens[68];
    } else if (this.indice == 14) {
      this.fundoBocaAberta = tdsImagens[69];
      this.fundoBocaFechada = tdsImagens[70];
    } else if (this.indice == 15) {
      this.fundoBocaAberta = tdsImagens[71];
      this.fundoBocaFechada = tdsImagens[72];
    } else if (this.indice == 16) {
      this.fundoBocaAberta = tdsImagens[73];
      this.fundoBocaFechada = tdsImagens[74];
    }
  }
  this.cursor = new Image();
  this.cursor = tdsImagens[1];
  this.ativo = true;
  this.cont = 0;
  this.cont2 = 0;
  this.fala = true;
  this.parteInst = new Array(false, false, false, false, false, false, false, false, false, false, false, false, false);
  if (this.indice == 2) {
    this.imgExtra = new Array();
    for (this.i = 0; this.i < 9; this.i++) {
      this.imgExtra.push(new Imagem(0, 0, 0, 0, ""));
      this.imgExtra[this.imgExtra.length - 1].img = tdsImagens[231 + this.i];
    }
  } else if (this.indice == 3) {
    this.imgExtra = new Array();
    for (this.i = 0; this.i < 14; this.i++) {
      this.imgExtra.push(new Imagem(0, 0, 0, 0, ""));
      this.imgExtra[this.imgExtra.length - 1].img = tdsImagens[240 + this.i];
    }
  } else if (this.indice == 5) {
    this.tras = new Image();
    this.tras = tdsImagens[163];
    this.seta = new Imagem(350, 250, 0, 0, "");
    this.seta.img = tdsImagens[254];
    this.botaoLeft = new Imagem(720, 500, 43, 89, "");
    this.botaoLeft.img = tdsImagens[169];
    this.botaoRight = new Imagem(660, 500, 43, 89, "");
    this.botaoRight.img = tdsImagens[170];
    this.imgExtra = new Array();
    for (this.i = 0; this.i < 4; this.i++) {
      this.imgExtra.push(new Imagem(0, 0, 0, 0, ""));
      this.imgExtra[this.imgExtra.length - 1].img = tdsImagens[255];
    }
  } else if (this.indice == 7) {
    this.tras = tdsImagens[256];
    this.seta = new Imagem(350, 250, 0, 0, "");
    this.seta.img = tdsImagens[254];
    this.botaoLeft = new Imagem(720, 500, 43, 89, "");
    this.botaoLeft.img = tdsImagens[169];
    this.botaoRight = new Imagem(660, 500, 43, 89, "");
    this.botaoRight.img = tdsImagens[170];
    this.imgExtra = new Array();
    for (this.i = 0; this.i < 4; this.i++) {
      this.imgExtra.push(new Imagem(0, 0, 0, 0, ""));
      this.imgExtra[this.imgExtra.length - 1].img = tdsImagens[257 + this.i];
    }
    this.imgExtra[0].x = 0; this.imgExtra[0].y = 10;
    this.imgExtra[1].x = 100; this.imgExtra[1].y = 130;
    this.imgExtra[2].x = 100; this.imgExtra[2].y = 300;
    this.imgExtra[3].x = 100; this.imgExtra[3].y = 500;
  } else if (this.indice == 10) {
    this.tras = tdsImagens[261];
    this.seta = new Imagem(350, 250, 0, 0, "");
    this.seta.img = tdsImagens[254];
    this.imgExtra = new Imagem(155, 350, 0, 0, "");
    this.imgExtra.img = tdsImagens[267];
  }


};

Instrucoes.prototype.Draw = function () {
  context.fillStyle = "black";
  if (this.indice == 17) {
    escore.Calcula();
    //aqui faz parar de desenhar recursivamente depois de mostrar a tela final
    telaAtual = false;
    /*} else if (this.indice == 18) {
      escore.ResultadoFinal();*/
  } else {
    if (this.indice == 2) {
      this.cont2++;
      if (this.cont2 > 30) {
        this.cont2 = 0;
        if (!this.parteInst[0]) this.parteInst[0] = true;
        else if (!this.parteInst[1]) this.parteInst[1] = true;
        else if (!this.parteInst[2]) this.parteInst[2] = true;
        else if (!this.parteInst[3]) this.parteInst[3] = true;
        else if (!this.parteInst[4]) this.parteInst[4] = true;
        else if (!this.parteInst[5]) this.parteInst[5] = true;
        else if (!this.parteInst[6]) this.parteInst[6] = true;
        else if (!this.parteInst[7]) this.parteInst[7] = true;
      }
      context.drawImage(this.imgExtra[0].img, 0, 0);
      if (this.parteInst[0]) {
        context.drawImage(this.imgExtra[1].img, 0, 0);
      } if (this.parteInst[1]) {
        context.drawImage(this.imgExtra[2].img, 0, 0);
      } if (this.parteInst[2]) {
        context.drawImage(this.imgExtra[3].img, 0, 0);
      } if (this.parteInst[3]) {
        context.drawImage(this.imgExtra[4].img, 0, 0);
      } if (this.parteInst[4]) {
        context.drawImage(this.imgExtra[5].img, 0, 0);
      } if (this.parteInst[5]) {
        context.drawImage(this.imgExtra[6].img, 0, 0);
      } if (this.parteInst[6]) {
        context.drawImage(this.imgExtra[7].img, 0, 0);
      } if (this.parteInst[7]) {
        context.drawImage(this.imgExtra[8].img, 0, 0);
        context.font = "40px Georgia";
        context.fillText("Clique para continuar", 200, 40);
      } if (this.parteInst[8]) {
        if (genero == 0) {
          this.fundoBocaAberta = tdsImagens[268];
          this.fundoBocaFechada = tdsImagens[269];
        } else {
          this.fundoBocaAberta = tdsImagens[270];
          this.fundoBocaFechada = tdsImagens[271];
        }
      }
    } else if (this.indice == 3) {
      this.cont2++;
      if (this.cont2 > 30) {
        this.cont2 = 0;
        if (!this.parteInst[0]) this.parteInst[0] = true;
        else if (!this.parteInst[1]) this.parteInst[1] = true;
        else if (!this.parteInst[2]) this.parteInst[2] = true;
        else if (!this.parteInst[3]) this.parteInst[3] = true;
        else if (!this.parteInst[4]) this.parteInst[4] = true;
        else if (!this.parteInst[5]) this.parteInst[5] = true;
        else if (!this.parteInst[6]) this.parteInst[6] = true;
        else if (!this.parteInst[7]) this.parteInst[7] = true;
        else if (!this.parteInst[8]) this.parteInst[8] = true;
        else if (!this.parteInst[9]) this.parteInst[9] = true;
        else if (!this.parteInst[10]) this.parteInst[10] = true;
        else if (!this.parteInst[11]) this.parteInst[11] = true;
        else if (!this.parteInst[12]) this.parteInst[12] = true;
      }
      context.drawImage(this.imgExtra[0].img, 0, 0);
      if (this.parteInst[0]) {
        context.drawImage(this.imgExtra[1].img, 0, 0);
      } if (this.parteInst[1]) {
        context.drawImage(this.imgExtra[2].img, 0, 0);
      } if (this.parteInst[2]) {
        context.drawImage(this.imgExtra[3].img, 0, 0);
      } if (this.parteInst[3]) {
        context.drawImage(this.imgExtra[4].img, 0, 0);
      } if (this.parteInst[4]) {
        context.drawImage(this.imgExtra[5].img, 0, 0);
      } if (this.parteInst[5]) {
        context.drawImage(this.imgExtra[6].img, 0, 0);
      } if (this.parteInst[6]) {
        context.drawImage(this.imgExtra[7].img, 0, 0);
      } if (this.parteInst[7]) {
        context.drawImage(this.imgExtra[8].img, 0, 0);
      } if (this.parteInst[8]) {
        context.drawImage(this.imgExtra[9].img, 0, 0);
      } if (this.parteInst[9]) {
        context.drawImage(this.imgExtra[10].img, 0, 0);
      } if (this.parteInst[10]) {
        context.drawImage(this.imgExtra[11].img, 0, 0);
      } if (this.parteInst[11]) {
        context.drawImage(this.imgExtra[12].img, 0, 0);
      } if (this.parteInst[12]) {
        context.drawImage(this.imgExtra[13].img, 0, 0);
        context.font = "40px Georgia";
        context.fillText("Clique para continuar", 200, 40);
      }
    } else if (this.indice == 5 || this.indice == 7 || this.indice == 10) {
      context.drawImage(this.tras, 0, 0);
      if (this.indice == 10) {
        context.drawImage(this.imgExtra.img, this.imgExtra.x, this.imgExtra.y);
        if (!this.parteInst[0]) {
          if (this.seta.x > 200) this.seta.x -= 3;
          if (this.seta.y < 390) this.seta.y += 3;
          if (this.seta.x <= 200 && this.seta.y >= 390) {
            this.parteInst[0] = true;
          }
        } else if (!this.parteInst[1]) {
          if (this.seta.x < 577) {
            this.seta.x += 3;
            this.imgExtra.x += 3;
          } if (this.seta.y > 187) {
            this.seta.y -= 3;
            this.imgExtra.y -= 3;
          } if (this.seta.x >= 577 && this.seta.y <= 187) {
            this.parteInst[1] = true;
            this.imgExtra.x = 532;
            this.imgExtra.y = 144;
          }
        }
        if (this.parteInst[1]) {
          context.font = "40px Georgia";
          context.fillText("Clique para continuar", 200, 40);
        }
      }
    } else if (this.indice == 16) {
      context.font = "40px Georgia";
      //context.fillText("Clique para ver os seus resultados", 120, 40);
    }
    //ISSO AQUI FOI PARA ME AJUDAR A ACHAR AS POSIÇÕES DO MOUSE NAS INSTRUÇÕES QUE O MOUSE MEXE SOZINHO
    //context.fillText("x:"+posMouseX+" - y:"+posMouseY,200,40);
    this.cont++;
    if (this.cont > 10) {
      this.cont = 0;
      this.fala = !this.fala;
    }

    let fundo = this.fala ? this.fundoBocaAberta : this.fundoBocaFechada;

    if (fundo.complete)
      context.drawImage(fundo, 0, 0);


    if (this.indice == 5) {
      for (this.i = 0; this.i < 4; this.i++) {
        context.drawImage(this.imgExtra[this.i].img, this.imgExtra[this.i].x, this.imgExtra[this.i].y);
      }
      context.drawImage(this.botaoLeft.img, this.botaoLeft.x, this.botaoLeft.y);
      context.drawImage(this.botaoRight.img, this.botaoRight.x, this.botaoRight.y);

      context.drawImage(this.seta.img, this.seta.x, this.seta.y);
      if (!this.parteInst[0]) {
        if (this.seta.x > 110) this.seta.x -= 3;
        if (this.seta.y > 85) this.seta.y -= 2;
        if (this.seta.x <= 110 && this.seta.y <= 85) {
          this.parteInst[0] = true;
          this.imgExtra[3].img = tdsImagens[272];
        }
      } else if (!this.parteInst[1]) {
        if (this.seta.x < 566) {
          this.seta.x += 4;
          this.imgExtra[3].x += 4;
        } if (this.seta.y < 288) {
          this.seta.y += 2;
          this.imgExtra[3].y += 2;
        }
        if (this.seta.x >= 566 && this.seta.y >= 288) {
          this.parteInst[1] = true;
          this.imgExtra[3].img = tdsImagens[255];
          this.imgExtra[3].x = 458;
          this.imgExtra[3].y = 209;
        }
      } else if (!this.parteInst[2]) {
        if (this.seta.x > 110) this.seta.x -= 5;
        if (this.seta.y > 85) this.seta.y -= 3;
        if (this.seta.x <= 110 && this.seta.y <= 85) {
          this.parteInst[2] = true;
          this.imgExtra[2].img = tdsImagens[272];
        }
      } else if (!this.parteInst[3]) {
        if (this.seta.x < 399) {
          this.seta.x += 6;
          this.imgExtra[2].x += 6;
        } if (this.seta.y < 472) {
          this.seta.y += 6;
          this.imgExtra[2].y += 6;
        }
        if (this.seta.x >= 399 && this.seta.y >= 472) {
          this.parteInst[3] = true;
        }
      } else if (!this.parteInst[4]) {
        if (this.seta.x < 673) {
          this.seta.x += 6;
        } if (this.seta.y < 538) {
          this.seta.y += 4;
        }
        if (this.seta.x >= 673 && this.seta.y >= 538) {
          this.parteInst[4] = true;
          this.imgExtra[2].img = tdsImagens[273];
          this.imgExtra[2].x = 311;//arrumando
          this.imgExtra[2].y = 358;
        }
      } else if (!this.parteInst[5]) {
        if (this.seta.x > 110) this.seta.x -= 6;
        if (this.seta.y > 85) this.seta.y -= 4;
        if (this.seta.x <= 110 && this.seta.y <= 85) {
          this.parteInst[5] = true;
          this.imgExtra[1].img = tdsImagens[272];
        }
      } else if (!this.parteInst[6]) {
        if (this.seta.x < 396) {
          this.seta.x += 6;
          this.imgExtra[1].x += 6;
        } if (this.seta.y < 129) {
          this.seta.y += 4;
          this.imgExtra[1].y += 4;
        }
        if (this.seta.x >= 396 && this.seta.y >= 129) {
          this.parteInst[6] = true;
        }
      } else if (!this.parteInst[7]) {
        if (this.seta.x < 746) {
          this.seta.x += 6;
        } if (this.seta.y < 539) {
          this.seta.y += 4;
        }
        if (this.seta.x >= 746 && this.seta.y >= 539) {
          this.imgExtra[1].img = tdsImagens[274];
          this.parteInst[7] = true;
          this.imgExtra[1].x = 311;
          this.imgExtra[1].y = 62;
        }
      } else if (!this.parteInst[8]) {
        if (this.seta.x > 110) this.seta.x -= 6;
        if (this.seta.y > 85) this.seta.y -= 6;
        if (this.seta.x <= 110 && this.seta.y <= 85) {
          this.parteInst[8] = true;
          this.imgExtra[0].img = tdsImagens[272];
        }
      } else if (!this.parteInst[9]) {
        if (this.seta.x < 223) {
          this.seta.x += 2;
          this.imgExtra[0].x += 2;
        } if (this.seta.y < 296) {
          this.seta.y += 4;
          this.imgExtra[0].y += 4;
        }
        if (this.seta.x >= 223 && this.seta.y >= 296) {
          this.parteInst[9] = true;
        }
      } else if (!this.parteInst[10]) {
        if (this.seta.x < 672) this.seta.x += 8;
        if (this.seta.y < 541) this.seta.y += 4;

        if (this.seta.x >= 672 && this.seta.y >= 541) {
          this.parteInst[10] = true;
          this.imgExtra[0].img = tdsImagens[273];
          this.imgExtra[0].x = 168;
          this.imgExtra[0].y = 211;
          this.cont3 = 0;
        }
      } else if (!this.parteInst[11]) {
        this.cont3++;
        if (this.cont3 >= 20) {
          this.imgExtra[0].img = tdsImagens[275];
          this.parteInst[11] = true;
        }
      }
      if (this.parteInst[11]) {
        context.font = "40px Georgia";
        context.fillText("Clique para continuar", 200, 40);
      }
    } else if (this.indice == 7) {
      for (this.i = 0; this.i < 4; this.i++) {
        context.drawImage(this.imgExtra[this.i].img, this.imgExtra[this.i].x, this.imgExtra[this.i].y);
      }
      context.drawImage(this.botaoLeft.img, this.botaoLeft.x, this.botaoLeft.y);
      context.drawImage(this.botaoRight.img, this.botaoRight.x, this.botaoRight.y);

      context.drawImage(this.seta.img, this.seta.x, this.seta.y);
      if (!this.parteInst[0]) {
        if (this.seta.x > 165) this.seta.x -= 3;
        if (this.seta.y > 47) this.seta.y -= 3;
        if (this.seta.x <= 165 && this.seta.y <= 47) {
          this.parteInst[0] = true;
        }
      } else if (!this.parteInst[1]) {
        if (this.seta.x < 444) {
          this.seta.x += 4;
          this.imgExtra[0].x += 4;
        } if (this.seta.y < 269) {
          this.seta.y += 3;
          this.imgExtra[0].y += 3;
        }
        if (this.seta.x >= 444 && this.seta.y >= 269) {
          this.parteInst[1] = true;
          this.imgExtra[0].x = 317;
          this.imgExtra[0].y = 250;
        }
      } else if (!this.parteInst[2]) {
        if (this.seta.x > 143) this.seta.x -= 5;
        if (this.seta.y > 167) this.seta.y -= 3;
        if (this.seta.x <= 143 && this.seta.y <= 167) {
          this.parteInst[2] = true;
        }
      } else if (!this.parteInst[3]) {
        if (this.seta.x < 359) {
          this.seta.x += 6;
          this.imgExtra[1].x += 6;
        } if (this.seta.y < 239) {
          this.seta.y += 6;
          this.imgExtra[1].y += 6;
        }
        if (this.seta.x >= 359 && this.seta.y >= 239) {
          this.parteInst[3] = true;
          this.imgExtra[1].x = 318;
          this.imgExtra[1].y = 174;
        }
      } else if (!this.parteInst[4]) {
        if (this.seta.x > 180) {
          this.seta.x -= 6;
        } if (this.seta.y < 541) {
          this.seta.y += 4;
        }
        if (this.seta.x <= 180 && this.seta.y >= 541) {
          this.parteInst[4] = true;
        }
      } else if (!this.parteInst[5]) {
        if (this.seta.x < 466) {
          this.seta.x += 6;
          this.imgExtra[3].x += 6;
        } if (this.seta.y > 220) {
          this.seta.y -= 6;
          this.imgExtra[3].y -= 6;
        }
        if (this.seta.x >= 466 && this.seta.y <= 220) {
          this.parteInst[5] = true;
          this.imgExtra[3].x = 394;
          this.imgExtra[3].y = 174;
        }
      } else if (!this.parteInst[6]) {
        if (this.seta.x > 152) this.seta.x -= 6;
        if (this.seta.y < 408) this.seta.y += 4;
        if (this.seta.x <= 152 && this.seta.y >= 408) {
          this.parteInst[6] = true;
        }
      } else if (!this.parteInst[7]) {
        if (this.seta.x < 366) {
          this.seta.x += 6;
          this.imgExtra[2].x += 6;
        } if (this.seta.y > 125) {
          this.seta.y -= 6;
          this.imgExtra[2].y -= 6;
        }
        if (this.seta.x >= 366 && this.seta.y <= 125) {
          this.parteInst[7] = true;
          this.imgExtra[2].x = 318;
          this.imgExtra[2].y = 21;
        }
      } if (this.parteInst[7]) {
        context.font = "40px Georgia";
        context.fillText("Clique para continuar", 100, 500);
      }
    } else if (this.indice == 10) {
      context.drawImage(this.seta.img, this.seta.x, this.seta.y);
    }
  }
  if (instrucoesPassoAPasso)
    instrucoesPassoAPasso.desenhaInstrucao(faseAtual, this.fala);

}

Instrucoes.prototype.MouseDown = function (mouseEvent) { }

Instrucoes.prototype.MouseUp = function (mouseEvent) {
  if (instrucoesPassoAPasso)
    instrucoesPassoAPasso.avancaInstrucao();
  if (this.indice == 4 || this.indice == 6 || this.indice == 8 || this.indice == 9 || this.indice == 11 || this.indice == 12 || this.indice == 13 || this.indice == 14 || this.indice == 15 || this.indice == 16) this.ativo = false;
  else if (this.indice == 5 && this.parteInst[11]) this.ativo = false;
  else if (this.indice == 7 && this.parteInst[7]) this.ativo = false;
  else if (this.indice == 10 && this.parteInst[1]) this.ativo = false;
  else if (this.indice == 2) {
    if (!this.parteInst[0]) this.parteInst[0] = true;
    else if (!this.parteInst[1]) this.parteInst[1] = true;
    else if (!this.parteInst[2]) this.parteInst[2] = true;
    else if (!this.parteInst[3]) this.parteInst[3] = true;
    else if (!this.parteInst[4]) this.parteInst[4] = true;
    else if (!this.parteInst[5]) this.parteInst[5] = true;
    else if (!this.parteInst[6]) this.parteInst[6] = true;
    else if (!this.parteInst[7]) this.parteInst[7] = true;
    else if (!this.parteInst[8]) this.parteInst[8] = true;
    else this.ativo = false;
  } else if (this.indice == 3) {
    if (!this.parteInst[0]) this.parteInst[0] = true;
    else if (!this.parteInst[1]) this.parteInst[1] = true;
    else if (!this.parteInst[2]) this.parteInst[2] = true;
    else if (!this.parteInst[3]) this.parteInst[3] = true;
    else if (!this.parteInst[4]) this.parteInst[4] = true;
    else if (!this.parteInst[5]) this.parteInst[5] = true;
    else if (!this.parteInst[6]) this.parteInst[6] = true;
    else if (!this.parteInst[7]) this.parteInst[7] = true;
    else if (!this.parteInst[8]) this.parteInst[8] = true;
    else if (!this.parteInst[9]) this.parteInst[9] = true;
    else if (!this.parteInst[10]) this.parteInst[10] = true;
    else if (!this.parteInst[11]) this.parteInst[11] = true;
    else if (!this.parteInst[12]) this.parteInst[12] = true;
    else this.ativo = false;
  }
}

Instrucoes.prototype.KeyDown = function (keyCode) { }
