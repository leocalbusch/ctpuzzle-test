var Sequencia = function (fase) {
  	this.fundo = new Image();
	this.fase=fase;
	if(this.fase==1)this.fundo=tdsImagens[205];
	if(this.fase==2)this.fundo=tdsImagens[206];
	this.ativo=true;
	this.pulou=false;
	this.imgPular= new Imagem(1000,560,0,0,"");
	this.imgPular.img = tdsImagens[87];
	this.errou = 0;
	this.perdeu = false;
	this.ganhou=false;
	// controle de tempo para resolução no nível
	// estava errado -leo
	this.tempo=0;
	this.agora = new Date();
	this.segundos = this.agora.getSeconds();
	// essa var serve para pausar a tela no "correto" antes de mudar de nível/fase
	this.pause = true;
	//
	this.botaoPular= new Imagem(1000,560,86,36,"");
	this.botaoPular.img = tdsImagens[84];
	this.botaoContinuar= new Imagem(380,565,150,25,"");
	this.botaoContinuar.img = tdsImagens[7];
	this.botaoDica= new Imagem(0,0,0,0,"");
	this.botaoDica.img = tdsImagens[151];
	this.botaoDicaUsada= new Imagem(0,0,0,0,"");
	this.botaoDicaUsada.img = tdsImagens[276];
	this.posRespCorreta = new Imagem(0,0,0,0,"");
	this.respCorreta = 0;
	this.dicaMostrada=new Array();
	this.dicaImagem=new Array();
	this.respostas=new Array();
	this.iRespostas = new Array();
	this.dicasUsadas = new Array(false,false,false);
	this.follow=-1;
	this.selected=-1;
	this.trace="";
	this.msg="";
	this.msg2="";
	this.msg3="";
	this.dicaAtual=-1;
	this.contDicas=0;
	if(this.fase==1){
		for(this.i=0;this.i<5;this.i++)this.iRespostas.push(this.i);
		this.iRespostas = shuffle(this.iRespostas);
		for(this.i=0;this.i<5;this.i++){
			this.respostas.push(new Imagem(20+(this.i*160),400,111,114,""));
			this.respostas[this.respostas.length-1].img=tdsImagens[207+this.iRespostas[this.i]];
		}
		this.posRespCorreta.x=546;
		this.posRespCorreta.y=136;
		this.respCorreta = 4;
	}else if(this.fase==2){
		for(this.i=0;this.i<8;this.i++)this.iRespostas.push(this.i);
		this.iRespostas = shuffle(this.iRespostas);
		for(this.i=0;this.i<8;this.i++){
			if(this.i<4)this.respostas.push(new Imagem(20,60+(this.i*133),111,114,""));
			else this.respostas.push(new Imagem(670,60+((this.i-4)*133),111,114,""));
			this.respostas[this.respostas.length-1].img=tdsImagens[212+this.iRespostas[this.i]];
		}
		this.posRespCorreta.x=520;
		this.posRespCorreta.y=280;
		this.respCorreta = 3;
	}
};

Sequencia.prototype.Draw = function(){
	context.drawImage(this.fundo, 0, 0);
	context.font="40px Georgia";
	//se o jogo está em curso conta o tempo
	if(this.ativo && !this.pulou && !this.ganhou && !this.perdeu) {
		this.agora = new Date();
		if(this.agora.getSeconds()!=this.segundos){
			this.tempo++;
			this.segundos = this.agora.getSeconds();
		}
	}
	if(this.tempo>=0)this.botaoPular.x=160;

	context.font="30px Georgia";

	if(this.ganhou){
		//Essa parte é responsável por mostrar que está certo e ir pra próxima fase
		context.fillText("Correto!",260,588);
		context.drawImage(this.botaoContinuar.img, this.botaoContinuar.x, this.botaoContinuar.y);
		this.msg="";
		// A variável "pause" fica setada para true até que o usuário clique na tela
		// Isso faz com que a tela fique parada mostrando "Correto" até o clique
		// *ver MouseUp
		if(!this.pause)this.ativo=false;
	}else if(this.perdeu){
		//Essa parte é responsável por contar os erros
		context.fillText("Errado!",260,588);
		context.drawImage(this.botaoContinuar.img, this.botaoContinuar.x, this.botaoContinuar.y);
		this.msg="";
		this.follow=-1;

		// se já se passaram 2 segundos, desativa o "pause" para recomeçar o nível
		if(!this.pause) {
			this.perdeu = false;
			this.iRespostas = shuffle(this.iRespostas);
			this.respostas = new Array();
			for (this.i = 0; this.i < 8; this.i++) {
				if (this.fase == 1) {
					if (this.i < 5) {
						this.respostas.push(new Imagem(20 + (this.i * 160), 400, 111, 114, ""));
						this.respostas[this.respostas.length - 1].img = tdsImagens[207 + this.iRespostas[this.i]];
					}
				} else {
					if (this.i < 4) this.respostas.push(new Imagem(20, 60 + (this.i * 133), 111, 114, ""));
					else this.respostas.push(new Imagem(670, 60 + ((this.i - 4) * 133), 111, 114, ""));
					this.respostas[this.respostas.length - 1].img = tdsImagens[212 + this.iRespostas[this.i]];
				}
			}
		}
	}else{
		if(!this.pulou){
			//Aqui faz as peças clicadas seguirem o mouse
			if(this.follow!=-1){
				this.respostas[this.follow].x=posMouseX-(this.respostas[this.follow].width/2);
				this.respostas[this.follow].y=posMouseY-(this.respostas[this.follow].height/2);
			//	this.trace=this.respostas[this.follow].x+"/"+this.respostas[this.follow].y;
			}else{
				for(this.i=0;this.i<this.respostas.length;this.i++){
					if(this.fase==1){
						this.respostas[this.i].x = 20+(this.i*160);
						this.respostas[this.i].y = 400;
					}
				}
			}
		}
	}

	//aqui mostra as opções de respostas
	for(this.i=0;this.i<this.respostas.length;this.i++){
		context.drawImage(this.respostas[this.i].img, this.respostas[this.i].x, this.respostas[this.i].y);
	}

	//aqui mostra os botões das dicas
	for(this.i=0;this.i<this.dicasUsadas.length;this.i++){
		if(this.dicasUsadas[this.i]) {
			context.drawImage(this.botaoDicaUsada.img, 710-(this.i*60), 15);
		}
		else context.drawImage(this.botaoDica.img, 710-(this.i*60), 15);
	}

	//Desenhando o botão pular
	context.drawImage(this.botaoPular.img, this.botaoPular.x, this.botaoPular.y);

	context.fillText("" + this.trace,150,70);
	context.font="24px Georgia";
	context.fillText("" + this.msg2,150,540);
	context.fillText("" + this.msg,20,540);
	context.fillText("" + this.msg3,150,510);
	/*context.font="28px Georgia";
	context.fillText("Tempo: " + Math.round(this.tempo),10,40);
	context.fillStyle="#FF003C";
	context.fillText("Tentativas: " + this.errou ,160,40);
	context.fillStyle="#FF8A00";
	context.fillText("Dicas: " + this.contDicas,320,40);*/
	context.fillStyle="black";
	context.font="40px Georgia";
	if(this.pulou){
		context.drawImage(this.imgPular.img, 0, 0, 800, 600);
	}
}

Sequencia.prototype.MouseDown = function(mouseEvent) {
	if(!this.perdeu && !this.ganhou && !this.pulou){
		for(this.i=(this.respostas.length-1);this.i>=0;this.i--){
			if(posMouseX>this.respostas[this.i].x && posMouseX<this.respostas[this.i].x+this.respostas[this.i].width && posMouseY>this.respostas[this.i].y && posMouseY<this.respostas[this.i].y+this.respostas[this.i].height){
				//o que estiver selecionado vai pra frente da tela:
				//gravei no aux//
				this.aux=this.respostas[this.respostas.length-1];
				this.auxI=this.iRespostas[this.respostas.length-1];
				//o i recebe o ultimo//
				this.respostas[this.respostas.length-1]=this.respostas[this.i];
				this.iRespostas[this.respostas.length-1]=this.iRespostas[this.i]
				//o ultimo recebe o aux//
				this.respostas[this.i]=this.aux;
				this.iRespostas[this.i]=this.auxI;
				//o follow recebe o ultimo//
				this.follow=this.respostas.length-1;
				break;
			}
		}
	}
}

Sequencia.prototype.MouseUp = function(mouseEvent) {
	if(!this.pulou){
		if (this.pause && this.ganhou){
			if(posMouseX>this.botaoContinuar.x && posMouseX<(this.botaoContinuar.x + this.botaoContinuar.width) && posMouseY>this.botaoContinuar.y && posMouseY<(this.botaoContinuar.y + this.botaoContinuar.height)){
				this.pause = false;
				return;
			}
		}
		if (this.pause && this.perdeu){
			if(posMouseX>this.botaoContinuar.x && posMouseX<(this.botaoContinuar.x + this.botaoContinuar.width) && posMouseY>this.botaoContinuar.y && posMouseY<(this.botaoContinuar.y + this.botaoContinuar.height)){
				this.pause = false;
				return;
			}
		}
		if(!this.perdeu && !this.ganhou){
		//Pular a fase
			if(this.tempo>=0){
				if(posMouseX>this.botaoPular.x && posMouseX<(this.botaoPular.x + this.botaoPular.width) && posMouseY>this.botaoPular.y && posMouseY<(this.botaoPular.y + this.botaoPular.height)){
					this.pulou=true;
				}
			}
			if(this.follow!=-1){
				if(this.respostas[this.follow].x>this.posRespCorreta.x-40 && this.respostas[this.follow].x<this.posRespCorreta.x+40 && this.respostas[this.follow].y>this.posRespCorreta.y-40 && this.respostas[this.follow].y<this.posRespCorreta.y+40){
					//VERIFICA SE EH O LOCAL E A FIGURA CORRETA;
					if(this.iRespostas[this.follow]==this.respCorreta){
						this.ganhou=true;
					}else{
						this.perdeu=true;
						this.errou++;
					}
					this.pause=true;
					this.respostas[this.follow].x=this.posRespCorreta.x;
					this.respostas[this.follow].y=this.posRespCorreta.y;
				}
			}
			this.follow=-1;

			for(this.i=0;this.i<this.dicasUsadas.length;this.i++){
				if(posMouseX>710-(this.i*60) && posMouseX<710-(this.i*60)+56 && posMouseY>20  && posMouseY<20+34 ){
					this.dicasUsadas[this.i] = true;
					if(this.contDicas<3)this.contDicas++;
					if(this.fase==1){
						if(this.i==2)this.msg="Parece que, a cada quadro, o círculo e o quadrado estão se movendo...";
						else if(this.i==1)this.msg="Para qual direção o círculo laranja avança em cada quadro?";
						else if(this.i==0)this.msg="Para qual direção o quadrado azul avança em cada quadro?";
					}else{
						if(this.i==0){
							this.msg3="Quanto mais à direita, menos colunas";
							this.msg2="a sequência de bolinhas apresenta...";
						}else if(this.i==1){
							this.msg3="Quanto mais abaixo, mais linhas";
							this.msg2="a sequência de bolinhas apresenta...";
						}else if(this.i==2){
							this.msg3="A resposta tem o número máximo de linhas";
							this.msg2="e o número mínimo de colunas da sequência.";
						}
					}
					break;
				}
			}
		}
	}else{
		if(posMouseX>455 && posMouseX<590 && posMouseY>365 && posMouseY<445){
			this.pulou=false;
		}else if(posMouseX>210 && posMouseX<340 && posMouseY>365 && posMouseY<445){
			this.ativo=false;
		}
	}
}

Sequencia.prototype.KeyDown = function (keyCode){}

//Função para randomizar array que peguei na internet
function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}
