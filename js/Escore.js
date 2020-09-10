var Escore = function () {
	this.tempoProg = new Array(0,0,0,0);
	this.comandosProg = new Array(0,0,0,0);
	this.deletadosProg = new Array(0,0,0,0);
	this.limpouProg = new Array(0,0,0,0);
	this.playProg = new Array(0,0,0,0);
	this.pulouProg = new Array(false,false,false,false);

	this.tempoProgLoop = new Array(0,0,0,0);
	this.comandosProgLoop = new Array(0,0,0,0);
	this.deletadosProgLoop = new Array(0,0,0,0);
	this.limpouProgLoop = new Array(0,0,0,0);
	this.playProgLoop = new Array(0,0,0,0);
	this.loopInstProgLoop = new Array(0,0,0,0);
	this.loopProgLoop = new Array(0,0,0,0);
	this.pulouProgLoop = new Array(false,false,false,false);
	
	this.tempoPontos = new Array(0,0,0,0);
	this.cliquesPontos = new Array(0,0,0,0);
	this.limpouPontos = new Array(0,0,0,0);
	this.dicasPontos = new Array(0,0,0,0);
	this.pulouPontos = new Array(false,false,false,false);
	
	this.tempoMatch = new Array(0,0);
	this.cliquesMatch = new Array(0,0);
	this.girosMatch = new Array(0,0);
	this.dicasMatch = new Array(0,0);
	this.pulouMatch = new Array(false,false);
	
	this.tempoTangram = new Array(0,0);
	this.cliquesTangram = new Array(0,0);
	this.girosTangram = new Array(0,0);
	this.dicasTangram = new Array(0,0);
	this.pulouTangram = new Array(false,false);
	
	this.tempoSeq = new Array(0,0);
	this.tentativasSeq = new Array(0,0);
	this.dicasSeq = new Array(0,0);
	this.pulouSeq = new Array(false,false);
	
	this.tempoClas = 0;
	this.tentativasClas = 0;
	this.limpouClas = 0;
	this.dicasClas = 0;
	this.pulouClas=0;
	
	//RESULTADOS:
	
	this.progResult= new Array(0,0,0,0);
	this.progLoopResult= new Array(0,0,0,0);
	this.pontosResult = new Array(0,0,0,0);
	this.matchResult = new Array(0,0);
	this.tangramResult = new Array(0,0);
	this.seqResult = new Array(0,0);
	this.clasResult=0;
};

Escore.prototype.Programacao = function(fase,tempo,comandos,deletados,limpou,play,pulou){
	this.tempoProg[fase]=tempo;
	this.comandosProg[fase]=comandos;
	this.deletadosProg[fase]=deletados;
	this.limpouProg[fase]=limpou;
	this.playProg[fase]=play;
	this.pulouProg[fase]=pulou;
}

Escore.prototype.ProgramacaoLoop = function(fase,tempo,comandos,deletados,limpou,play,loop,loopInst,pulou){
	this.tempoProgLoop[fase]=tempo;
	this.comandosProgLoop[fase]=comandos;
	this.deletadosProgLoop[fase]=deletados;
	this.limpouProgLoop[fase]=limpou;
	this.playProgLoop[fase]=play;
	this.pulouProgLoop[fase]=pulou;
	this.loopProgLoop[fase]=loop;
	this.loopInstProgLoop[fase]=loopInst;
}

Escore.prototype.Pontos = function(fase,tempo,cliques,limpou,dicas,pulou){
	this.tempoPontos[fase]=tempo;
	this.cliquesPontos[fase]=cliques;
	this.limpouPontos[fase]=limpou;
	this.dicasPontos[fase]=dicas;
	this.pulouPontos[fase]=pulou;
}

Escore.prototype.Match = function(fase,tempo,cliques,giros,dicas,pulou){
	this.tempoMatch[fase]=tempo;
	this.cliquesMatch[fase]=cliques;
	this.girosMatch[fase]=giros;
	this.dicasMatch[fase]=dicas;
	this.pulouMatch[fase]=pulou;
}

Escore.prototype.Tangram = function(fase,tempo,cliques,giros,dicas,pulou){
	this.tempoTangram[fase]=tempo;
	this.cliquesTangram[fase]=cliques;
	this.girosTangram[fase]=giros;
	this.dicasTangram[fase]=dicas;
	this.pulouTangram[fase]=pulou;
}

Escore.prototype.Sequencia = function(fase, tempo, tentativas, dicas, pulou){
	this.tempoSeq[fase]=tempo;
	this.tentativasSeq[fase]=tentativas;
	this.dicasSeq[fase]=dicas;
	this.pulouSeq[fase]=pulou;
}

Escore.prototype.Classifica = function(tempo,tentativas,limpou,dicas,pulou){
	this.tempoClas = tempo;
	this.tentativasClas = tentativas;
	this.limpouClas = limpou;
	this.dicasClas = dicas;
	this.pulouClas=pulou;
}

Escore.prototype.Calcula = function(){
//Programação: 
	context.fillStyle="#FF8A00";
	context.font="20px Georgia";
	context.fillText("Fase Programação",30,140);
	for(this.i=0;this.i<this.progResult.length;this.i++){
		if(this.pulouProg[this.i])this.progResult[this.i]=0;
		else{
			if(this.i==0 || this.i==1){ //se é a fase 1 ou 2 sem loop
				if(this.playProg[this.i]==1) { // se passou com apenas 1 play
					// número de instruções utilizadas na melhor solução
					this.Imin=4;
					// número de plays utilizados na melhor solução
					this.Pmax=1;
				}else if(this.playProg[this.i]==2 || this.playProg[this.i]==3){ // se passou com 2 ou 3 play
					this.Imin=2;
					this.Pmax=2;
				}else{ // se passou com mais de 3 play
					this.Imin=1;
					this.Pmax=4;
				}
			}else if(this.i==2){ // se é a fase 3
				if(this.playProg[this.i]==1){
					this.Imin=5;
					this.Pmax=1;
				}else if(this.playProg[this.i]>=2 && this.playProg[this.i]<=4){
					this.Imin=4;
					this.Pmax=2;
				}else{
					this.Imin=2;
					this.Pmax=5;
				}
			}else if(this.i==3){ // se é a fase 4
				if(this.playProg[this.i]==1){
					this.Imin=5;
					this.Pmax=1;
				}else if(this.playProg[this.i]==2){
					this.Imin=4;
					this.Pmax=2;
				}else{
					this.Imin=3;
					this.Pmax=3;
				}
			}
			// F1 = 1 - ((I - Imin) * 0.001) - (A * 0.05) - (L * 0.001) - ((P - Pmax) * 0.01) - (T * 0.001)
			// I = quantas instruções (comandos) utilizadas
			// Imin = quantidade de instruções da melhor solução
			// A = quantas instruções apagadas (deletadas)
			// L = quantas vezes clicou no botão "Limpar"
			// P = quantas vezes clicou no botão "Play"
			// Pmax = quantidade de "Play" da melhor solução
			// T = tempo em segundos
			// ESSA FÓRMULA ESTAVA ERRADA -LEO
			this.progResult[this.i] = 1-((this.comandosProg[this.i]-this.Imin)*0.001)-(this.deletadosProg[this.i]*0.05)-(this.limpouProg[this.i]*0.001)-((this.playProg[this.i]-this.Pmax)*0.01)-(this.tempoProg[this.i]*0.001);
			// F1 =                   1-((                       I - Imin    )*0.001)-(                        A*0.05)-(                      L*0.001)-((                    P-Pmax     )*0.01)-(                     T*0.001)
		}
		if(this.progResult[this.i]>1)this.progResult[this.i]=1;
		else if(this.progResult[this.i]<0)this.progResult[this.i]=0;
		context.font="20px Georgia";
		context.fillText("Nível "+(this.i+1)+": " + Math.round(this.progResult[this.i]*100) ,50,170+(30*this.i));
	}
	context.fillStyle="#ff003c";
	context.font="20px Georgia";
	context.fillText("Fase Programação (Loop)",30,440);
	for(this.i=0;this.i<this.progLoopResult.length;this.i++){
		if(this.pulouProgLoop[this.i])this.progLoopResult[this.i]=0;
		else{
			// se não usou loop
			if(this.loopInstProgLoop[this.i]==0){
				// se é a primeira fase de loop
				if(this.i==0){
					if(this.playProgLoop[this.i]==1) { // se apertou Play 1 vez
						this.Imin=14;
						this.Pmax=1;
					}else if(this.playProgLoop[this.i]==2){ // se apertou Play 2 vezes
						this.Imin=8;
						this.Pmax=2;
					}else if(this.playProgLoop[this.i]==3){ // se apertou Play 3 vezes
						this.Imin=6;
						this.Pmax=3;
					}else if(this.playProgLoop[this.i]==4 || this.playProgLoop[this.i]==5){ // se apertou Play 4 ou 5 vezes
						this.Imin=4;
						this.Pmax=4;
					}else{ // se apertou Play mais de 5 vezes
						this.Imin=2;
						this.Pmax=7;
					}
					// se é a segunda fase de loop
				}else if(this.i==1){
					if(this.playProgLoop[this.i]==1){ // se apertou Play 1 vez
						this.Imin=9;
						this.Pmax=1;
					}else if(this.playProgLoop[this.i]==2){ // se apertou Play 2 vezes
						this.Imin=5;
						this.Pmax=2;
					}else if(this.playProgLoop[this.i]>=3 && this.playProgLoop[this.i]<=5){ // se apertou Play , 4 ou 5 vezes
						this.Imin=3;
						this.Pmax=3;
					}else{ // se apertou Play mais de 5 vezes
						this.Imin=2;
						this.Pmax=6;
					}
				}
				this.progLoopResult[this.i] = 0.7-((this.comandosProgLoop[this.i]-this.Imin)*0.001)-(this.deletadosProgLoop[this.i]*0.001)-(this.limpouProgLoop[this.i]*0.001)-((this.playProgLoop[this.i]-this.Pmax)*0.001)-(this.tempoProgLoop[this.i]*0.001)-(this.loopProgLoop[this.i]*0.001);
			// se usou loops
			}else if(this.loopInstProgLoop[this.i]>0){
				// se é a primeira fase de loop
				if(this.i==0){
					this.Lomin=1;
					//se tem 1 loop
					if(this.loopInstProgLoop[this.i]==1) {
						this.M=0.85;
						this.ILomin=1;
						if(this.playProgLoop[this.i]==1) { // se apertou Play 1 vez
							this.Imin=9;
						}else if(this.playProgLoop[this.i]==2){ // se apertou Play 2 vezes
							this.Imin=6;
						}else if(this.playProgLoop[this.i]==3){ // se apertou Play 3 vezes
							this.Imin=5;
						}else if(this.playProgLoop[this.i]>=4 && this.playProgLoop[this.i]<=6){ // se apertou Play 4, 5 ou 6 vezes
							this.Imin=4;
						}else{
							this.Imin=3; // se apertou Play mais de 6 vezes
						}
					//se tem mais de 1 loop
					}else{
						this.M=1;
						this.ILomin=2;
						this.Imin=3;
					}
				// se é a segunda fase de loop
				}else if(this.i==1){
					// se tem 1 loop
					if(this.loopInstProgLoop[this.i]==1) {
						this.M=0.85;
						this.ILomin=1;
						this.Lomin=1;
						if(this.playProgLoop[this.i]==1) { // se apertou Play 1 vez
							this.Imin=5;
						}else if(this.playProgLoop[this.i]==2){ // se apertou Play 2 vezes
							this.Imin=4;
						}else{ // se apertou Play mais de 2 vezes
							this.Imin=3;
						}
					}else{ //se tem mais de 1 loop
						this.M=1;
						this.Lomin=2;
						this.ILomin=2;
						this.Imin=4;
					}
				}
				this.progLoopResult[this.i]=this.M-((this.comandosProgLoop[this.i]-this.Imin)*0.001)-(this.deletadosProgLoop[this.i]*0.001)-(this.limpouProgLoop[this.i]*0.001)-((this.playProgLoop[this.i]-1)*0.001)-((this.loopProgLoop[this.i]-this.Lomin)*0.001)-((this.loopInstProgLoop[this.i]-this.ILomin)* 0.001)-(this.tempoProgLoop[this.i]*0.001);
			}	
		}
		context.font="20px Georgia";
		if(this.progLoopResult[this.i]>1)this.progLoopResult[this.i]=1;
		else if(this.progLoopResult[this.i]<0)this.progLoopResult[this.i]=0;
		context.fillText("Nível "+(this.i+1)+": " + Math.round(this.progLoopResult[this.i]*100),50,470+(30*this.i));
	}
	context.fillStyle="#C44D58";
	context.font="20px Georgia";
	context.fillText("Fase Pontos",330,140);
	for(this.i=0;this.i<this.pontosResult.length;this.i++){
		if(this.pulouPontos[this.i])this.pontosResult[this.i]=0;
		else{
			// se for os níveis 0 e 1 o Cmin é 9
			// nos demais níveis o Cmin é 13
			if(this.i<2)this.Cmin=9;
			else this.Cmin=13;
			// F2=1-((C- Cmin)*0.001)-(D*0.5)-(L*0.001)-(T*0.01)
			// C = quantos cliques foram usados
			// Cmin = Cliques da melhor solução
			// D = quantas dicas foram usadas
			// L = quantas vezes usou o "Limpar"
			// T = tempo em segundos
			this.pontosResult[this.i]=1-((this.cliquesPontos[this.i]-this.Cmin)*0.001)-(this.dicasPontos[this.i]*0.5)-(this.limpouPontos[this.i]*0.001)-(this.tempoPontos[this.i]*0.01);
			//                        1-((                         C-Cmin     )*0.001)-(                       D*0.5)-(                        L*0.001)-(                       T*0.01)
			if(this.pontosResult[this.i]>1)this.pontosResult[this.i]=1;
			else if(this.pontosResult[this.i]<0)this.pontosResult[this.i]=0;
		}
		context.fillText("Nível "+(this.i+1)+": " + Math.round(this.pontosResult[this.i]*100),330,140+(30*(this.i+1)));
	}
	context.fillStyle="#FF6B6B";
	context.font="20px Georgia";
	context.fillText("Fase Formas geométricas",550,140);
	for(this.i=0;this.i<this.matchResult.length;this.i++){
		if(this.pulouMatch[this.i])this.matchResult[this.i]=0;
		else{
			//TALVEZ COM AS MELHORIAS QUE EU FIZ NO CÓDIGO VAI ACABAR DIMINUINDO MAIS AINDA O VALOR MINIMO DE CLIQUES
			//POIS AGORA É POSSÍVEL POSICIONAR NO LUGAR, GIRAR, E SE GIRAR E TIVER NO LUGAR CERTO JÁ FICA
			//SEM PRECISAR CLICAR UMA SEGUNDA VEZ... PRECISAMOS FAZER VÁRIOS TESTES PRA CONFIRMAR ISSO
			
			if(this.i==0){
				this.Gmin=8;
				this.Cmin=8;
			}else{
				this.Gmin=16;
				this.Cmin=14;
			}
			this.matchResult[this.i]=1-((this.cliquesMatch[this.i]-this.Cmin)*0.001)-((this.girosMatch[this.i]-this.Gmin)*0.001)-(this.dicasMatch[this.i]*0.05)-(this.tempoMatch[this.i]*0.01);
			if(this.matchResult[this.i]>1)this.matchResult[this.i]=1;
			else if(this.matchResult[this.i]<0)this.matchResult[this.i]=0;
		}
		context.fillText("Nível "+(this.i+1)+": " + Math.round(this.matchResult[this.i]*100),550,140+(30*(this.i+1)));
	}
	context.fillStyle="#C7F464";
	context.font="20px Georgia";
	context.fillText("Fase Tangram",550,280);
	for(this.i=0;this.i<this.tangramResult.length;this.i++){
		if(this.pulouTangram[this.i])this.tangramResult[this.i]=0;
		else{
			//TALVEZ COM AS MELHORIAS QUE EU FIZ NO CÓDIGO VAI ACABAR DIMINUINDO MAIS AINDA O VALOR MINIMO DE CLIQUES
			//POIS AGORA É POSSÍVEL POSICIONAR NO LUGAR, GIRAR, E SE GIRAR E TIVER NO LUGAR CERTO JÁ FICA
			//SEM PRECISAR CLICAR UMA SEGUNDA VEZ... PRECISAMOS FAZER VÁRIOS TESTES PRA CONFIRMAR ISSO
			if(this.i==0){
				this.Cmin=5;
				this.Gmin=5;
			}else{
				this.Cmin=6;
				this.Gmin=6;
			}
			this.tangramResult[this.i]=1-((this.cliquesTangram[this.i]-this.Cmin)*0.001)-((this.girosTangram[this.i]-this.Gmin)*0.001)-(this.dicasTangram[this.i]*0.2)-(this.tempoTangram[this.i]*0.005);
			if(this.tangramResult[this.i]>1)this.tangramResult[this.i]=1;
			else if(this.tangramResult[this.i]<0)this.tangramResult[this.i]=0;
		}
		context.fillText("Nível "+(this.i+1)+": " + Math.round(this.tangramResult[this.i]*100),550,280+(30*(this.i+1)));
	}
	context.fillStyle="#4ECDC4";
	context.font="20px Georgia";
	context.fillText("Fase Sequência",330,440);
	for(this.i=0;this.i<this.seqResult.length;this.i++){
		if(this.pulouSeq[this.i])this.seqResult[this.i]=0;
		else this.seqResult[this.i]=1-(this.tentativasSeq[this.i]*0.001)-(this.dicasSeq[this.i]*0.5)-(this.tempoSeq[this.i]*0.01);
		if(this.seqResult[this.i]>1)this.seqResult[this.i]=1;
		else if(this.seqResult[this.i]<0)this.seqResult[this.i]=0;
		context.fillText("Nível "+(this.i+1)+": " + Math.round(this.seqResult[this.i]*100),330,440+(30*(this.i+1)));
	}
	context.fillStyle="#556270";
	context.font="20px Georgia";
	context.fillText("Fase Classificação",550,440);
	if(this.pulouClas)this.clasResult = 0;
	else this.clasResult = 1-(this.tentativasClas*0.01)-(this.limpouClas*0.001)-(this.dicasClas*0.4)-(this.tempoClas*0.001);
	if(this.clasResult>1)this.clasResult=1;
	else if(this.clasResult<0)this.clasResult=0;
	context.fillText("Nível único: "+ Math.round(this.clasResult*100),550,470);
	
	context.fillStyle="black";

	this.algoritmo=(((this.progResult[0]*0.4)+(this.progResult[1]*0.4)+(this.progResult[2]*0.4)+(this.progResult[3]*0.4)+(this.progLoopResult[0]*0.4)+(this.progLoopResult[1]*0.4)+(this.progLoopResult[2]*0.4)+(this.progLoopResult[3]*0.4))/3.2);
	this.abstracao=(((this.progResult[0]*0.1)+(this.progResult[1]*0.1)+(this.progResult[2]*0.1)+(this.progResult[3]*0.1)+(this.progLoopResult[0]*0.1)+(this.progLoopResult[1]*0.1)+(this.progLoopResult[2]*0.1)+(this.progLoopResult[3]*0.1)+(this.pontosResult[0]*0.4)+(this.pontosResult[1]*0.4)+(this.pontosResult[2]*0.4)+(this.pontosResult[3]*0.4)+(this.matchResult[0]*0.2)+(this.matchResult[1]*0.2)+(this.tangramResult[0]*0.2)+(this.tangramResult[1]*0.2)+(this.seqResult[0]*0.2)+(this.seqResult[1]*0.2)+(this.clasResult*0.4))/4);
	this.decomposicao=(((this.progResult[0]*0.45)+(this.progResult[1]*0.45)+(this.progResult[2]*0.45)+(this.progResult[3]*0.45)+(this.progLoopResult[0]*0.45)+(this.progLoopResult[1]*0.45)+(this.progLoopResult[2]*0.4)+(this.progLoopResult[3]*0.4)+(this.pontosResult[0]*0.2)+(this.pontosResult[1]*0.2)+(this.pontosResult[2]*0.2)+(this.pontosResult[3]*0.2)+(this.matchResult[0]*0.4)+(this.matchResult[1]*0.4)+(this.tangramResult[0]*0.4)+(this.tangramResult[1]*0.4)+(this.seqResult[0]*0.4)+(this.seqResult[1]*0.4)+(this.clasResult*0.3))/7);
	this.reconhecimento=(((this.progResult[0]*0.1)+(this.progResult[1]*0.1)+(this.progResult[2]*0.1)+(this.progResult[3]*0.1)+(this.progLoopResult[0]*0.1)+(this.progLoopResult[1]*0.1)+(this.progLoopResult[2]*0.1)+(this.progLoopResult[3]*0.1)+(this.pontosResult[0]*0.4)+(this.pontosResult[1]*0.4)+(this.pontosResult[2]*0.4)+(this.pontosResult[3]*0.4)+(this.matchResult[0]*0.4)+(this.matchResult[1]*0.4)+(this.tangramResult[0]*0.4)+(this.tangramResult[1]*0.4)+(this.seqResult[0]*0.4)+(this.seqResult[1]*0.4)+(this.clasResult*0.3))/5.1);
	
	context.font="22px Georgia";
	context.fillText("Algoritmo:" + Math.round(this.algoritmo*100) + "    Abstração: "+ Math.round(this.abstracao*100) + "    Decomposição:"+ Math.round(this.decomposicao*100) + "     Reconhecimento de padrões:" + Math.round(this.reconhecimento*100) ,10,90); 
	
	context.font="40px Georgia";
	context.fillText("Escore geral: " + Math.round((this.algoritmo+this.abstracao+this.decomposicao+this.reconhecimento)/4*100),260,40); 



	// Monta argumentos GET para enviar via AJAX para o bd.php
	this.agora = new Date();
	this.str = "dataHora=" + this.agora + "&";
	this.str+= "aluno=" + nomeJogador + "&";

	////////// FASE LIGAR PONTOS //////////

	// Fase Pontos Nível 0
	this.str+= "pontosGeral0=" + this.pontosResult[0] + "&";
	this.str+= "pontosDica0=" + this.dicasPontos[0] + "&";
	this.str+= "pontosClicks0=" + this.cliquesPontos[0] + "&";
	this.str+= "pontosTempo0=" + this.tempoPontos[0] + "&";
	this.str+= "pontosLimpar0=" + this.limpouPontos[0] + "&";
	this.str+= "pontosPulou0=" + this.pulouPontos[0] + "&";
	// Fase Pontos Nível 1
	this.str+= "pontosGeral1=" + this.pontosResult[1] + "&";
	this.str+= "pontosDica1=" + this.dicasPontos[1] + "&";
	this.str+= "pontosClicks1=" + this.cliquesPontos[1] + "&";
	this.str+= "pontosTempo1=" + this.tempoPontos[1] + "&";
	this.str+= "pontosLimpar1=" + this.limpouPontos[1] + "&";
	this.str+= "pontosPulou1=" + this.pulouPontos[1] + "&";
	// Fase Pontos Nível 2
	this.str+= "pontosGeral2=" + this.pontosResult[2] + "&";
	this.str+= "pontosDica2=" + this.dicasPontos[2] + "&";
	this.str+= "pontosClicks2=" + this.cliquesPontos[2] + "&";
	this.str+= "pontosTempo2=" + this.tempoPontos[2] + "&";
	this.str+= "pontosLimpar2=" + this.limpouPontos[2] + "&";
	this.str+= "pontosPulou2=" + this.pulouPontos[2] + "&";
	// Fase Pontos Nível 3
	this.str+= "pontosGeral3=" + this.pontosResult[3] + "&";
	this.str+= "pontosDica3=" + this.dicasPontos[3] + "&";
	this.str+= "pontosClicks3=" + this.cliquesPontos[3] + "&";
	this.str+= "pontosTempo3=" + this.tempoPontos[3] + "&";
	this.str+= "pontosLimpar3=" + this.limpouPontos[3] + "&";
	this.str+= "pontosPulou3=" + this.pulouPontos[3] + "&";

	////////// FASE MATCH //////////

	// Fase Match Nível 0
	this.str+= "matchGeral0=" + this.matchResult[0] + "&";
	this.str+= "matchDica0=" + this.dicasMatch[0] + "&";
	this.str+= "matchClicks0=" + this.cliquesMatch[0] + "&";
	this.str+= "matchTempo0=" + this.tempoMatch[0] + "&";
	this.str+= "matchGiros0=" + this.girosMatch[0] + "&";
	this.str+= "matchPulou0=" + this.pulouMatch[0] + "&";
	// Fase Match Nível 1
	this.str+= "matchGeral1=" + this.matchResult[1] + "&";
	this.str+= "matchDica1=" + this.dicasMatch[1] + "&";
	this.str+= "matchClicks1=" + this.cliquesMatch[1] + "&";
	this.str+= "matchTempo1=" + this.tempoMatch[1] + "&";
	this.str+= "matchGiros1=" + this.girosMatch[1] + "&";
	this.str+= "matchPulou1=" + this.pulouMatch[1] + "&";

	////////// FASE TANGRAM //////////

	// Fase Tangram Nível 0
	this.str+= "tangramGeral0=" + this.tangramResult[0] + "&";
	this.str+= "tangramDica0=" + this.dicasTangram[0] + "&";
	this.str+= "tangramClicks0=" + this.cliquesTangram[0] + "&";
	this.str+= "tangramTempo0=" + this.tempoTangram[0] + "&";
	this.str+= "tangramGiros0=" + this.girosTangram[0] + "&";
	this.str+= "tangramPulou0=" + this.pulouTangram[0] + "&";
	// Fase Tangram Nível 1
	this.str+= "tangramGeral1=" + this.tangramResult[1] + "&";
	this.str+= "tangramDica1=" + this.dicasTangram[1] + "&";
	this.str+= "tangramClicks1=" + this.cliquesTangram[1] + "&";
	this.str+= "tangramTempo1=" + this.tempoTangram[1] + "&";
	this.str+= "tangramGiros1=" + this.girosTangram[1] + "&";
	this.str+= "tangramPulou1=" + this.pulouTangram[1] + "&";

	////////// FASE CLASSIFICA //////////

	// Fase Classifica Nível 0
	this.str+= "classificaGeral=" + this.clasResult + "&";
	this.str+= "classificaTempo=" + this.tempoClas + "&";
	this.str+= "classificaDica=" + this.dicasClas + "&";
	this.str+= "classificaTentativa=" + this.tentativasClas + "&";
	this.str+= "classificaLimpar=" + this.limpouClas + "&";
	this.str+= "classificaPulou=" + this.pulouClas + "&";

	////////// FASE SEQUENCIA //////////

	// Fase Sequencia Nível 0
	this.str+= "sequenciaGeral0=" + this.seqResult[0] + "&";
	this.str+= "sequenciaTempo0=" + this.tempoSeq[0] + "&";
	this.str+= "sequenciaDica0=" + this.dicasSeq[0] + "&";
	this.str+= "sequenciaTentativa0=" + this.tentativasSeq[0] + "&";
	this.str+= "sequenciaPulou0=" + this.pulouSeq[0] + "&";
	// Fase Sequencia Nível 1
	this.str+= "sequenciaGeral1=" + this.seqResult[1] + "&";
	this.str+= "sequenciaTempo1=" + this.tempoSeq[1] + "&";
	this.str+= "sequenciaDica1=" + this.dicasSeq[1] + "&";
	this.str+= "sequenciaTentativa1=" + this.tentativasSeq[1] + "&";
	this.str+= "sequenciaPulou1=" + this.pulouSeq[1] + "&";

	////////// FASE PROGRAMAÇÃO //////////

	// Fase Prog Nível 0
	this.str+= "progGeral0=" + this.progResult[0] + "&";
	this.str+= "progTempo0=" + this.tempoProg[0] + "&";
	this.str+= "progInstrucoes0=" + this.comandosProg[0] + "&";
	this.str+= "progApagou0=" + this.deletadosProg[0] + "&";
	this.str+= "progApagouAll0=" + this.limpouProg[0] + "&";
	this.str+= "progPlay0=" + this.playProg[0] + "&";
	this.str+= "progPulou0=" + this.pulouProg[0] + "&";
	//Fase Prog Nível 1
	this.str+= "progGeral1=" + this.progResult[1] + "&";
	this.str+= "progTempo1=" + this.tempoProg[1] + "&";
	this.str+= "progInstrucoes1=" + this.comandosProg[1] + "&";
	this.str+= "progApagou1=" + this.deletadosProg[1] + "&";
	this.str+= "progApagouAll1=" + this.limpouProg[1] + "&";
	this.str+= "progPlay1=" + this.playProg[1] + "&";
	this.str+= "progPulou1=" + this.pulouProg[1] + "&";
	//Fase Prog Nível 2
	this.str+= "progGeral2=" + this.progResult[2] + "&";
	this.str+= "progTempo2=" + this.tempoProg[2] + "&";
	this.str+= "progInstrucoes2=" + this.comandosProg[2] + "&";
	this.str+= "progApagou2=" + this.deletadosProg[2] + "&";
	this.str+= "progApagouAll2=" + this.limpouProg[2] + "&";
	this.str+= "progPlay2=" + this.playProg[2] + "&";
	this.str+= "progPulou2=" + this.pulouProg[2] + "&";
	//Fase Prog Nível 3
	this.str+= "progGeral3=" + this.progResult[3] + "&";
	this.str+= "progTempo3=" + this.tempoProg[3] + "&";
	this.str+= "progInstrucoes3=" + this.comandosProg[3] + "&";
	this.str+= "progApagou3=" + this.deletadosProg[3] + "&";
	this.str+= "progApagouAll3=" + this.limpouProg[3] + "&";
	this.str+= "progPlay3=" + this.playProg[3] + "&";
	this.str+= "progPulou3=" + this.pulouProg[3] + "&";

	////////// FASE PROGRAMAÇÃO COM LOOP//////////

	//Fase ProgLoop Nível 0
	this.str+= "progLoopGeral0=" + this.progLoopResult[0] + "&";
	this.str+= "progTempoLoop0=" + this.tempoProgLoop[0] + "&";
	this.str+= "progInstrucoesLoop0=" + this.comandosProgLoop[0] + "&";
	this.str+= "progApagouLoop0=" + this.deletadosProgLoop[0] + "&";
	this.str+= "progApagouAllLoop0=" + this.limpouProgLoop[0] + "&";
	this.str+= "progPlayLoop0=" + this.playProgLoop[0] + "&";
	this.str+= "progLoopLoop0=" + this.loopProgLoop[0] + "&";
	this.str+= "progInstrucoesLoopLoop0=" + this.loopInstProgLoop[0] + "&";
	this.str+= "progPulouLoop0=" + this.pulouProgLoop[0] + "&";
	//Fase ProgLoop Nível 1
	this.str+= "progLoopGeral1=" + this.progLoopResult[1] + "&";
	this.str+= "progTempoLoop1=" + this.tempoProgLoop[1] + "&";
	this.str+= "progInstrucoesLoop1=" + this.comandosProgLoop[1] + "&";
	this.str+= "progApagouLoop1=" + this.deletadosProgLoop[1] + "&";
	this.str+= "progApagouAllLoop1=" + this.limpouProgLoop[1] + "&";
	this.str+= "progPlayLoop1=" + this.playProgLoop[1] + "&";
	this.str+= "progLoopLoop1=" + this.loopProgLoop[1] + "&";
	this.str+= "progInstrucoesLoopLoop1=" + this.loopInstProgLoop[1] + "&";
	this.str+= "progPulouLoop1=" + this.pulouProgLoop[1] + "&";
	//Fase ProgLoop Nível 2
	this.str+= "progLoopGeral2=" + this.progLoopResult[2] + "&";
	this.str+= "progTempoLoop2=" + this.tempoProgLoop[2] + "&";
	this.str+= "progInstrucoesLoop2=" + this.comandosProgLoop[2] + "&";
	this.str+= "progApagouLoop2=" + this.deletadosProgLoop[2] + "&";
	this.str+= "progApagouAllLoop2=" + this.limpouProgLoop[2] + "&";
	this.str+= "progPlayLoop2=" + this.playProgLoop[2] + "&";
	this.str+= "progLoopLoop2=" + this.loopProgLoop[2] + "&";
	this.str+= "progInstrucoesLoopLoop2=" + this.loopInstProgLoop[2] + "&";
	this.str+= "progPulouLoop2=" + this.pulouProgLoop[2] + "&";
	//Fase ProgLoop Nível 3
	this.str+= "progLoopGeral3=" + this.progLoopResult[3] + "&";
	this.str+= "progTempoLoop3=" + this.tempoProgLoop[3] + "&";
	this.str+= "progInstrucoesLoop3=" + this.comandosProgLoop[3] + "&";
	this.str+= "progApagouLoop3=" + this.deletadosProgLoop[3] + "&";
	this.str+= "progApagouAllLoop3=" + this.limpouProgLoop[3] + "&";
	this.str+= "progPlayLoop3=" + this.playProgLoop[3] + "&";
	this.str+= "progLoopLoop3=" + this.loopProgLoop[3] + "&";
	this.str+= "progInstrucoesLoopLoop3=" + this.loopInstProgLoop[3] + "&";
	this.str+= "progPulouLoop3=" + this.pulouProgLoop[3] + "&";

	////////// ESCORE NOS PILARES DO PC //////////
	this.str+= "abstracao=" + this.abstracao + "&";
	this.str+= "decomposicao=" + this.decomposicao + "&";
	this.str+= "reconhecimento=" + this.reconhecimento + "&";
	this.str+= "algoritmo=" + this.algoritmo;
	console.log(this.str);


	// Adiciona resultado no BD
	$.ajax({
		type: "POST",
		url: "bd.php",
		cache: false,
		data: this.str,
		dataType: "application/x-www-form-urlencoded",
		success: function(response) {
			if (!response.error) {
				alert(response.msg);
			} else {
				alert(response.msg);
			}
		}
	});

}

Escore.prototype.ResultadoFinal = function() {
//Programação:
	context.fillStyle = "#FF8A00";
	context.font = "20px Georgia";
	context.fillText("Fase Programação", 30, 140);
	for (this.i = 0; this.i < this.progResult.length; this.i++) {
		context.font = "20px Georgia";
		context.fillText("Nível " + (this.i + 1) + ": " + Math.round(this.progResult[this.i] * 100), 50, 170 + (30 * this.i));
	}
	context.fillStyle = "#ff003c";
	context.font = "20px Georgia";
	context.fillText("Fase Programação (Loop)", 30, 440);
	for (this.i = 0; this.i < this.progLoopResult.length; this.i++) {
		context.font = "20px Georgia";
		context.fillText("Nível " + (this.i + 1) + ": " + Math.round(this.progLoopResult[this.i] * 100), 50, 470 + (30 * this.i));
	}
	context.fillStyle = "#C44D58";
	context.font = "20px Georgia";
	context.fillText("Fase Pontos", 330, 140);
	for (this.i = 0; this.i < this.pontosResult.length; this.i++) {
		context.fillText("Nível " + (this.i + 1) + ": " + Math.round(this.pontosResult[this.i] * 100), 330, 140 + (30 * (this.i + 1)));
	}
	context.fillStyle = "#FF6B6B";
	context.font = "20px Georgia";
	context.fillText("Fase Formas geométricas", 550, 140);
	for (this.i = 0; this.i < this.matchResult.length; this.i++) {
		context.fillText("Nível " + (this.i + 1) + ": " + Math.round(this.matchResult[this.i] * 100), 550, 140 + (30 * (this.i + 1)));
	}
	context.fillStyle = "#C7F464";
	context.font = "20px Georgia";
	context.fillText("Fase Tangram", 550, 280);
	for (this.i = 0; this.i < this.tangramResult.length; this.i++) {
		context.fillText("Nível " + (this.i + 1) + ": " + Math.round(this.tangramResult[this.i] * 100), 550, 280 + (30 * (this.i + 1)));
	}
	context.fillStyle = "#4ECDC4";
	context.font = "20px Georgia";
	context.fillText("Fase Sequência", 330, 440);
	for (this.i = 0; this.i < this.seqResult.length; this.i++) {
		context.fillText("Nível " + (this.i + 1) + ": " + Math.round(this.seqResult[this.i] * 100), 330, 440 + (30 * (this.i + 1)));
	}
	context.fillStyle = "#556270";
	context.font = "20px Georgia";
	context.fillText("Fase Classificação", 550, 440);
	context.fillText("Nível único: " + Math.round(this.clasResult * 100), 550, 470);

	context.fillStyle = "black";

	context.font = "22px Georgia";
	context.fillText("Algoritmo:" + Math.round(this.algoritmo * 100) + "    Abstração: " + Math.round(this.abstracao * 100) + "    Decomposição:" + Math.round(this.decomposicao * 100) + "     Reconhecimento de padrões:" + Math.round(this.reconhecimento * 100), 10, 90);

	context.font = "40px Georgia";
	context.fillText("Escore geral: " + Math.round((this.algoritmo + this.abstracao + this.decomposicao + this.reconhecimento) / 4 * 100), 260, 40);
}