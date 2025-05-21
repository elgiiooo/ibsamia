<?php

add_action( 'wp_footer', 'quiz_script', 999 );
 
function quiz_script() {  
		
?>





<script>

jQuery(function($){
	
	
$(window).on('load', function() {
   $('#multi-step-form').each(function() {
      this.reset();
   });
});

$(window).on('pageshow', function(event) {
   if (event.originalEvent.persisted) {
      $('#multi-step-form').each(function() {
         this.reset();
      });
   }
});		
	
	
$(document).ready(function() {
	
	
  // Variabili globali
  var currentStep = 1;
  var totalSteps = $('#multi-step-form .step').length;

  // Nasconde tutti i passaggi tranne il primo
  $('#multi-step-form .step').not('.step-1').hide();

  // Funzione per passare al passaggio successivo
  $('#multi-step-form').on('click', '.next-step', function(event) {
  //$('.next-step').click(function() {
	event.preventDefault();
    currentStep++;
    if (currentStep > totalSteps) {
      currentStep = totalSteps;
    }
    $('#multi-step-form .step').hide();
    $('#multi-step-form .step-' + currentStep).show();
  });

	
	
  // Funzione per tornare al passaggio precedente
  $('#multi-step-form').on('click', '.prev-step', function(event) {
  //$('.prev-step').click(function() {
	event.preventDefault();
    currentStep--;
    if (currentStep < 1) {
      currentStep = 1;
    }
    $('#multi-step-form .step').hide();
    $('#multi-step-form .step-' + currentStep).show();
  });

	
	
  // Funzione per ricominciare il form dall'inizio
  $('#multi-step-form').on('click', '.restart', function(event) {
  //$('.restart').click(function() {
	event.preventDefault();
    currentStep = 1;
    $('#multi-step-form .step').hide();
    $('#multi-step-form .step-' + currentStep).show();
  });

	
		


	
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////// CLICK OPTION STEP 1 -> update content step 2 ////////////////////////////////////////  
  $('#multi-step-form').on('change', '.step-1 input', function(event) {  
	    
	// disabilito avanti
	if ($('.step-1 input[type=radio]:checked').length > 0) {
		$('.step-1 .next-step').prop('disabled', false);
	}    
    // Otteniamo il valore dell'opzione selezionata
    var selectedValue = $(this).val();
    // Creiamo il nuovo contenuto in base alla scelta effettuata dall'utente
    var newContent = '';
	  
	/////////////////// SE SELEZIONO OPZIONE A /////////////////
    if (selectedValue === 'a') {		
		newContent = '\
			<div class="box-domanda"><div class="titolo">Bocca: quali sintomi hai?</div><img src="/wp-content/uploads/2023/03/quiz-header.png"></div>\
			<div class="box-risposte">\
				<div class="radio-option">\
				  <input type="radio" id="aa" name="answer2" value="aa">\
				  <label for="aa">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/bolle.png"></div>\
					<p><span>A</span>"Bolle"</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="ab" name="answer2" value="ab">\
				  <label for="ab">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/lesioni.png"></div>\
					<p><span>B</span>Piccole lesioni causate dall\'apparecchio / protesi</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="ac" name="answer2" value="ac">\
				  <label for="ac">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/gengivegonfie.png"></div>\
					<p><span>C</span>Gengive gonfie e/o doloranti</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="ad" name="answer2" value="ad">\
				  <label for="ad">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/gengivesanguin.png"></div>\
					<p><span>D</span>Gengive sanguinanti</p>\
				  </label>\
				</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button disabled class="next-step">></button>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE B /////////////////
    if (selectedValue === 'b') {		
		newContent = '\
			<div class="box-domanda"><div class="titolo">Pelle: quali sintomi hai?</div><img src="/wp-content/uploads/2023/03/quiz-header.png"></div>\
			<div class="box-risposte">\
				<div class="radio-option">\
				  <input type="radio" id="ba" name="answer2" value="ba">\
				  <label for="ba">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/ba.png"></div>\
					<p><span>A</span>Ferita/escoriazione abrasione</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="bb" name="answer2" value="bb">\
				  <label for="bb">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/bb.png"></div>\
					<p><span>B</span>Leggera ustione</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="bc" name="answer2" value="bc">\
				  <label for="bc">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/bc.png"></div>\
					<p><span>C</span>Eritema da pannolino</p>\
				  </label>\
				</div>\
				<div class="radio-option nuovadomanda">\
				  <input type="radio" id="bd" name="answer2" value="bd">\
				  <label for="bd">\
					<div class="imgc"><img src="/wp-content/uploads/2024/07/bd.png"></div>\
					<p><span>D</span>Sensazione di tensione continua, secchezza, rossore, ruvidezza</p>\
				  </label>\
				</div>\
				<div class="radio-option nuovadomanda">\
				  <input type="radio" id="be" name="answer2" value="be">\
				  <label for="be">\
					<div class="imgc"><img src="/wp-content/uploads/2024/07/be.png"></div>\
					<p><span>E</span>Sensazione di tensione localizzata, pelle spenta</p>\
				  </label>\
				</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button disabled class="next-step">></button>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  
	  
	  
    // Aggiorniamo il contenuto dello step successivo
    $('.step-2').html(newContent);	  

  });		
	
	
	
	
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////// CLICK OPTION STEP 2 -> update content step 3 ////////////////////////////////////////  
  $('#multi-step-form').on('change', '.step-2 input', function(event) {  
	    
	// disabilito avanti
	if ($('.step-2 input[type=radio]:checked').length > 0) {
		$('.step-2 .next-step').prop('disabled', false);
	}    
    // Otteniamo il valore dell'opzione selezionata
    var selectedValue = $(this).val();
    // Creiamo il nuovo contenuto in base alla scelta effettuata dall'utente
    var newContent = '';
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE AA /////////////////
    if (selectedValue === 'aa') {		
		newContent = '\
			<div class="box-domanda"><div class="titolo">Che aspetto hanno le bolle?</div><img src="/wp-content/uploads/2023/03/quiz-header.png"></div>\
			<div class="box-risposte">\
				<div class="radio-option">\
				  <input type="radio" id="aaa" name="answer3" value="aaa">\
				  <label for="aaa">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/3a.png"></div>\
					<p><span>A</span>Hanno un aspetto biancastro</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="aab" name="answer3" value="aab">\
				  <label for="aab">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/3b.png"></div>\
					<p><span>B</span>Sono rosse e piene di sangue</p>\
				  </label>\
				</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button disabled class="next-step">></button>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////

	  
	/////////////////// SE SELEZIONO OPZIONE AB /////////////////
    if (selectedValue === 'ab') {		
		newContent = '\
			<div class="box-domanda"><div class="titolo">Le lesioni causate dall\'apparecchio/protesi sono:</div><img src="/wp-content/uploads/2023/03/quiz-header.png"></div>\
			<div class="box-risposte">\
				<div class="radio-option">\
				  <input type="radio" id="aba" name="answer3" value="aba">\
				  <label for="aba">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/3a-num-diff.png"></div>\
					<p><span>A</span>Numerose e diffuse in tutto il cavo orale</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="abb" name="answer3" value="abb">\
				  <label for="abb">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/3b-num-loc.png"></div>\
					<p><span>B</span>Numerose e localizzate anche in punti difficilmente raggiungibili</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="abc" name="answer3" value="abc">\
				  <label for="abc">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/3c-local.png"></div>\
					<p><span>C</span>Localizzate</p>\
				  </label>\
				</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button disabled class="next-step">></button>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE AC /////////////////
    if (selectedValue === 'ac') {		
		newContent = '\
			<div class="box-domanda"><div class="titolo">Il tuo problema alle gengive:</div><img src="/wp-content/uploads/2023/03/quiz-header.png"></div>\
			<div class="box-risposte">\
				<div class="radio-option">\
				  <input type="radio" id="aca" name="answer3" value="aca">\
				  <label for="aca">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/aca.png"></div>\
					<p><span>A</span>È limitato ad un\'area localizzata</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="acb" name="answer3" value="acb">\
				  <label for="acb">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/acb.png"></div>\
					<p><span>B</span>È esteso</p>\
				  </label>\
				</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button disabled class="next-step">></button>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////		  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE AD /////////////////
    if (selectedValue === 'ad') {		
		newContent = '\
			<div class="box-domanda"><div class="titolo">Il tuo problema alle gengive:</div><img src="/wp-content/uploads/2023/03/quiz-header.png"></div>\
			<div class="box-risposte">\
				<div class="radio-option">\
				  <input type="radio" id="ada" name="answer3" value="ada">\
				  <label for="ada">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/aca.png"></div>\
					<p><span>A</span>È limitato ad un\'area localizzata</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="adb" name="answer3" value="adb">\
				  <label for="adb">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/acb.png"></div>\
					<p><span>B</span>È esteso</p>\
				  </label>\
				</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button disabled class="next-step">></button>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////		 	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE BA /////////////////
    if (selectedValue === 'ba') {		
		newContent = '\
			<div class="box-domanda"><div class="titolo">Hai una ferita/escoriazione/abrasione.</div><img src="/wp-content/uploads/2023/03/quiz-header.png"></div>\
			<div class="box-risposte">\
				<div class="radio-option">\
				  <input type="radio" id="baa" name="answer3" value="baa">\
				  <label for="baa">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/baa.png"></div>\
					<p><span>A</span>Per disinfettarla</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="bab" name="answer3" value="bab">\
				  <label for="bab">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/bab.png"></div>\
					<p><span>B</span>Per favorire la cicatrizzazione</p>\
				  </label>\
				</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button disabled class="next-step">></button>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////			  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE BB /////////////////
    if (selectedValue === 'bb') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">In caso di ustioni minori, puoi provare Euclorina® ProDERMA Crema oppure Euclorina® ProDERMA Spray</div>\
					<div class="box-azzuro">\
						<div class="box-1">Euclorina® ProDERMA Crema ed Euclorina® ProDERMA Spray favoriscono una rapida cicatrizzazione, creando una barriera protettiva contro le aggressioni microbiche e favorendo i processi di rigenerazione tissutale.\
		<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatti per<br><b>tutta la famiglia</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/spray-bambini.png"><span><b>SPRAY</b><br>Adatto ai bambini 0+</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/crema-bambini.png"><span><b>CREMA</b><br>Adatta ai bambini 3+</span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2023/03/proderma-pack.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-pelle/riparazione-cute/">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-pro-spray">\
					<div class="box-blu">Un consiglio in più</div>\
					<div class="box-consiglio text-s">La pelle è considerata a tutti gli effetti un organo che tra le tante funzioni si occupa di proteggere il nostro corpo da agenti esterni, come una vera e propria barriera.  Abrasioni, piaghe infette, ascessi, foruncoli e paterecci sono solo alcuni dei fattori che influiscono negativamente sulla salute della pelle. In queste situazioni è fondamentale <b>medicare le ferite</b> e <b>favorire la cicatrizzazione</b>.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////		  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE BC /////////////////
    if (selectedValue === 'bc') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">Se il tuo bambino soffre di eritema da pannolino, puoi provare Euclorina® ProDERMA Spray</div>\
					<div class="box-azzuro">\
						<div class="box-1">Euclorina® ProDERMA Spray forma una barriera protettiva contro le aggressioni microbiche, favorendo la rigenerazione della cute, per una rapida cicatrizzazione. Se il tuo bambino è un neonato, puoi usare Euclorina® ProDERMA Spray anche per la medicazione del moncone ombelicale.\
		<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatto per<br><b>tutta la famiglia</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/spray-bambini.png"><span><b>SPRAY</b><br>Adatto ai bambini 0+</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/senza-alcool.png"><span><b>Senza alcool<br>Non brucia</b></span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2023/03/proderma-single.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-pelle/riparazione-cute/#spray">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-pro-spray-2">\
					<div class="box-blu">Un consiglio in più</div>\
					<div class="box-consiglio">Ci sono alcuni momenti della vita del nostro bambino in cui può essere più soggetto all’eritema da pannolino. In questo periodo è ancora più importante cambiare il pannolino non appena si sporca e mantenere l’ambiente del pannolino <b>pulito</b> e <b>asciutto</b>.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////		  
	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE BD /////////////////
    if (selectedValue === 'bd') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-grigio">In caso di pelle secca, puoi provare Euclorina® proDERMA Idratante Nutriente</div>\
					<div class="box-azzuro">\
						<div class="box-1">Grazie alla sua Formulazione con Vitamina A, Euclorina® ProDERMA Idratante Nutriente favorisce un\'ottimale idratazione e l\'elasticità necessaria per svolgere le funzioni vitali e protettive della pelle. La Vitamina A è essenziale per l\'equilibrio della pelle: la mantiene liscia e morbida evitandole secchezza e irritazione, grazie alla sua capacità di regolare il rinnovamento cellulare dell\'epitelio.\
		<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2024/07/icodonna.png"><span>Viso e mani</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2024/07/icodonna2.png"><span>Aree specifiche</span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2024/07/Linea_Notifica_Rid.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-pelle/proderma-crema/">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx prodermaback1">\
					<div class="box-blu">Un consiglio in più</div>\
					<div class="box-consiglio">La pelle secca è una condizione permanente, causata da una mancanza di lipidi. È consigliabile evitare lavaggi troppo frequenti e prolungati, l\'acqua molto calda e saponi aggressivi, optando invece per creme e oli detergenti. Anche utilizzare <b>creme specifiche</b>, con proprietà <b>idratanti</b> e <b>nutrienti</b>, può aiutare a mantenere la pelle morbida, elastica e levigata. </div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////			  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE BE /////////////////
    if (selectedValue === 'be') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-grigio">In caso di pelle disidratata, puoi provare Euclorina® proDERMA Idratante Nutriente</div>\
					<div class="box-azzuro">\
						<div class="box-1">Grazie alla sua Formulazione con Vitamina A, Euclorina® ProDERMA Idratante Nutriente favorisce un\'ottimale idratazione e l\'elasticità necessaria per svolgere le funzioni vitali e protettive della pelle. La Vitamina A è essenziale per l\'equilibrio della pelle: la mantiene liscia e morbida evitandole secchezza e irritazione, grazie alla sua capacità di regolare il rinnovamento cellulare dell\'epitelio.\
		<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2024/07/icodonna.png"><span>Viso e mani</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2024/07/icodonna2.png"><span>Aree specifiche</span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2024/07/Linea_Notifica_Rid.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-pelle/proderma-crema/">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx prodermaback1">\
					<div class="box-blu">Un consiglio in più</div>\
					<div class="box-consiglio">La pelle disidratata è una condizione temporanea che può interessare qualsiasi tipo di pelle (secca, grassa o mista). Oltre ad idratare a sufficienza l\'organismo bevendo almeno 1,5 litri di acqua al giorno, è consigliabile evitare lavaggi troppo frequenti, saponi aggressivi e acqua molto calda. Anche l\'applicazione regolare di <b>creme idratanti</b> appositamente formulate può aiutare a mantenere la <b>pelle idratata</b> ed <b>elastica</b>.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////		  
	  
	  
	  
	  
	  
    // Aggiorniamo il contenuto dello step successivo
    $('.step-3').html(newContent);	  

  });	
	
	
	
	
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////// CLICK OPTION STEP 3 -> update content step 4 ////////////////////////////////////////  
  $('#multi-step-form').on('change', '.step-3 input', function(event) {  
	    
	// disabilito avanti
	if ($('.step-3 input[type=radio]:checked').length > 0) {
		$('.step-3 .next-step').prop('disabled', false);
	}    
    // Otteniamo il valore dell'opzione selezionata
    var selectedValue = $(this).val();
    // Creiamo il nuovo contenuto in base alla scelta effettuata dall'utente
    var newContent = '';
	
	  
	/////////////////// SE SELEZIONO OPZIONE AAA /////////////////
    if (selectedValue === 'aaa') {		
		newContent = '\
			<div class="box-domanda"><div class="titolo">Quando le "bolle" hanno un aspetto biancastro, potrebbe trattarsi di afte. Le afte sono:</div><img src="/wp-content/uploads/2023/03/quiz-header.png"></div>\
			<div class="box-risposte">\
				<div class="radio-option option-height">\
				  <input type="radio" id="aaaa" name="answer4" value="aaaa">\
				  <label for="aaaa">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/4a.png"></div>\
					<p><span>A</span>Diffuse ed estese e posizionate anche nella parte posteriore della bocca</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="aaab" name="answer4" value="aaab">\
				  <label for="aaab">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/4b.png"></div>\
					<p><span>B</span>Singole e diffuse</p>\
				  </label>\
				</div>\
				<div class="radio-option">\
				  <input type="radio" id="aaac" name="answer4" value="aaac">\
				  <label for="aaac">\
					<div class="imgc"><img src="/wp-content/uploads/2023/03/4c.png"></div>\
					<p><span>C</span>Singole e piccole</p>\
				  </label>\
				</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button disabled class="next-step">></button>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE AAB /////////////////
    if (selectedValue === 'aab') {		
		newContent = '\
			<div class="box-medico-azzurro">\
				<img src="/wp-content/uploads/2023/03/box-medico.png">\
				<div class="bm-text">Se le tue \'bolle\' sono rosse e c\'è presenza di sangue, rivolgiti al tuo medico per un consiglio.</div>\
			</div>\
			<div class="box-frecce">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  
	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE ABA /////////////////
    if (selectedValue === 'aba') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">Se le lesioni sono numerose e diffuse in tutto il cavo orale, puoi provare Euclorina® Afte Collutorio</div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Sollievo rapido e duraturo contro le afte dalla 1ª applicazione</p> Euclorina® Afte Collutorio svolge cinque azioni: riveste la superficie mucosa creando una barriera che riduce il dolore, la protegge dagli agenti esterni, idrata i tessuti danneggiati favorendo la cicatrizzazione e donando sollievo duraturo dalla prima applicazione.<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/barriera1.png"></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/trattamento.png"><span><b>Trattamento quotidiano protettivo</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatto per<br><b>tutta la famiglia</b></span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2024/04/AFTE_Collutorio_120m_trequarti_2024.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-afte/#collutorio">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-denti">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">Apparecchi ortodontici o protesi possono provocare piccole lesioni, anche impercettibili, favorendo l’insorgenza di afte. È importante in questo caso <b>curare</b> in modo particolare <b>l\'alimentazione</b> e mantenere una <b>scrupolosa igiene orale</b>.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE ABB /////////////////
    if (selectedValue === 'abb') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">Se le lesioni sono numerose e localizzate anche in punti difficilmente raggiungibili, puoi provare Euclorina® Afte Spray </div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Sollievo rapido e duraturo contro le afte dalla 1ª applicazione</p> Euclorina® Afte Spray svolge cinque azioni contro le afte: riveste la superficie mucosa creando una barriera che riduce il dolore, la protegge dagli agenti esterni, idrata i tessuti danneggiati favorendo la cicatrizzazione e donando sollievo duraturo dalla prima applicazione.<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/applicatore.png"><span><b>Applicatore mirato</b> per raggiungere le lesioni anche nelle zone più difficili</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatto per<br><b>tutta la famiglia</b></span></div>\
</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2024/04/AFTE_Spray-trequarti_2024_noFlac-1.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-afte/#spray">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-denti">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">Apparecchi ortodontici o protesi possono provocare piccole lesioni, anche impercettibili, favorendo l’insorgenza di afte. È importante in questo caso <b>curare</b> in modo particolare <b>l\'alimentazione</b> e mantenere una <b>scrupolosa igiene orale</b>.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE ABC /////////////////
    if (selectedValue === 'abc') {		
		newContent = '\
			<div class="ris-quiz-box-full box-v2">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">Se le lesioni sono localizzate, puoi provare Euclorina® Afte Gel </div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Sollievo rapido e duraturo contro le afte dalla 1ª applicazione</p> Euclorina® Afte Gel svolge cinque azioni contro le afte: riveste la superficie mucosa creando una barriera che riduce il dolore, la protegge dagli agenti esterni, idrata i tessuti danneggiati favorendo la cicatrizzazione e donando sollievo duraturo dalla prima applicazione.<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/barriera1.png"></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/beccuccio.png"><span><b>Beccuccio di precisione</b> per un\'applicazione mirata per lesioni circoscritte</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatto per<br><b>tutta la famiglia</b></span></div>\
	</div>\
						</div>\
						<div class="box-32">\
							<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-afte/#gel">Scopri di più</a></div>\
							<div class="box-2"><img src="/wp-content/uploads/2024/04/AFTE_Gel_box_8ml_trequarti_2024.png"></div>\
						</div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-denti">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">Apparecchi ortodontici o protesi possono provocare piccole lesioni, anche impercettibili, favorendo l’insorgenza di afte. È importante in questo caso <b>curare</b> in modo particolare <b>l\'alimentazione</b> e mantenere una <b>scrupolosa igiene orale</b>.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE ACA /////////////////
    if (selectedValue === 'aca') {		
		newContent = '\
			<div class="ris-quiz-box-full box-v2">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso box-rosa">Se il tuo problema alle gengive è limitato ad un’area localizzata, puoi provare Euclorina® Gengive Gel</div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Trattamento delle infiammazioni, sanguinamenti e traumi gengivali del cavo orale.</p> Euclorina® Gengive Gel forma una pellicola protettiva che aderisce alla mucosa orale impedendo ulteriori irritazioni, agendo contro agenti esterni e prevenendo infezioni orali. <div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/sollievo-rapido.png"><span><b>Sollievo immediato</b><br>dal dolore</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/non-macchia.png"><span><b>Non macchia<br>i denti</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/riduce-il.png"><span><b>Riduce il sanguinamento e l’insorgere della placca</b></span></div>\
	</div>\
						</div>\
						<div class="box-32">\
							<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-gengiviti/#gel">Scopri di più</a></div>\
							<div class="box-2"><img src="/wp-content/uploads/2024/04/GENGIVE_Gel_2024-1.png"></div>\
						</div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-geng-gel">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">Perché le gengive si infiammano? Il problema si manifesta principalmente quando vi è una <b>scarsa igiene orale</b>. La causa principale è la <b>placca</b>, ecco perché è bene lavare almeno due o tre volte al giorno i denti e utilizzare filo interdentale o scovolino per eliminare residui di cibo.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  	  
	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE ACB /////////////////
    if (selectedValue === 'acb') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso box-rosa">Se il tuo problema alle gengive è esteso, puoi provare Euclorina® Gengive Collutorio</div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Trattamento delle infiammazioni, sanguinamenti e traumi gengivali del cavo orale.</p> Euclorina® Gengive Collutorio forma una pellicola protettiva che aderisce alla mucosa orale impedendo ulteriori irritazioni, agendo contro agenti esterni e prevenendo infezioni orali.\
		<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/sollievo-rapido.png"><span><b>Sollievo immediato</b><br>dal dolore</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/non-macchia.png"><span><b>Non macchia<br>i denti</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/riduce-il.png"><span><b>Riduce il sanguinamento e l’insorgere della placca</b></span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2024/04/GENGIVE_Collutorio_2024.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-gengiviti/#collutorio">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-geng-coll">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">Oltre a scegliere il collutorio adatto per la gengivite è importante anche utilizzarlo correttamente.  Ad esempio, salvo indicazione del dentista il <b>collutorio non va diluito</b>. Poiché alcuni dentifrici possono vanificare l’effetto protettivo del collutorio, si consiglia di eseguire gli sciacqui con il collutorio circa <b>30 minuti dopo</b> aver lavato i denti.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  	  	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE ADA /////////////////
    if (selectedValue === 'ada') {		
		newContent = '\
			<div class="ris-quiz-box-full box-v2">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso box-rosa">Se il tuo problema alle gengive è limitato ad un’area localizzata, puoi provare Euclorina® Gengive Gel</div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Trattamento delle infiammazioni, sanguinamenti e traumi gengivali del cavo orale.</p> Euclorina® Gengive Gel forma una pellicola protettiva che aderisce alla mucosa orale impedendo ulteriori irritazioni, agendo contro agenti esterni e prevenendo infezioni orali. <div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/sollievo-rapido.png"><span><b>Sollievo rapido</b><br>dal dolore</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/non-macchia.png"><span><b>Non macchia<br>i denti</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/riduce-il.png"><span><b>Riduce il sanguinamento e l’insorgere della placca</b></span></div>\
	</div>\
						</div>\
						<div class="box-32">\
							<div class="box-3"><a target="_blank" target="_blank" href="/salute-della-bocca/euclorina-gengiviti/#gel">Scopri di più</a></div>\
							<div class="box-2"><img src="/wp-content/uploads/2024/04/GENGIVE_Gel_2024-1.png"></div>\
						</div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-geng-gel">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">Perché le gengive si infiammano? Il problema si manifesta principalmente quando vi è una <b>scarsa igiene orale</b>. La causa principale è la <b>placca</b>, ecco perché è bene lavare almeno due o tre volte al giorno i denti e utilizzare filo interdentale o scovolino per eliminare residui di cibo.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	
	  	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE ADB /////////////////
    if (selectedValue === 'adb') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso box-rosa">Se il tuo problema alle gengive è esteso, puoi provare Euclorina® Gengive Collutorio</div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Trattamento delle infiammazioni, sanguinamenti e traumi gengivali del cavo orale.</p> Euclorina® Gengive Collutorio forma una pellicola protettiva che aderisce alla mucosa orale impedendo ulteriori irritazioni, agendo contro agenti esterni e prevenendo infezioni orali.\
		<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/sollievo-rapido.png"><span><b>Sollievo immediato</b><br>dal dolore</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/non-macchia.png"><span><b>Non macchia<br>i denti</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/riduce-il.png"><span><b>Riduce il sanguinamento e l’insorgere della placca</b></span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2024/04/GENGIVE_Collutorio_2024.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-gengiviti/#collutorio">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-geng-coll">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">Oltre a scegliere il collutorio adatto per la gengivite è importante anche utilizzarlo correttamente.  Ad esempio, salvo indicazione del dentista il <b>collutorio non va diluito</b>. Poiché alcuni dentifrici possono vanificare l’effetto protettivo del collutorio, si consiglia di eseguire gli sciacqui con il collutorio circa <b>30 minuti dopo</b> aver lavato i denti.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////		  
	  
	  
	
	/////////////////// SE SELEZIONO OPZIONE BAA /////////////////
    if (selectedValue === 'baa') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso box-verde">Per disinfettare una ferita superficiale, un’escoriazione o un’abrasione, puoi provare Euclorina® Polvere Solubile</div>\
					<div class="box-azzuro">\
						<div class="box-1 w50"><p>Euclorina®, medicinale di automedicazione, è forte contro i batteri e delicata sulle mucose.</p> Euclorina® Polvere Solubile con la sua azione disinfettante rallenta e impedisce la crescita dei batteri.\
		<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/disinf-pelle.png"><span>Disinfezione<br>della <b>pelle</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/disinf-genitali.png"><span>Disinfezione<br>dei <b>genitali esterni</b></span></div>\
		</div>\
						</div>\
						<div class="box-2 w50"><img src="/wp-content/uploads/2023/03/Polv-Sol.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-pelle/disinfezione-cute-mucose/#polvere">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-0">\
					<div class="box-blu">Un consiglio in più</div>\
					<div class="box-consiglio text-s">Dopo essersi assicurati di avere le mani pulite vi sono alcuni passaggi fondamentali da seguire nel disinfettare correttamente una ferita:\
						<span>pulire la ferita da eventuali corpi estranei, che possono essere penetrati in essa</span>\
						<span>non mettere il ghiaccio direttamente sulla ferita</span>\
						<span>non usare il cotone per medicare in quanto potrebbero rimanerne filamenti all’interno della ferita</span>\
						<span>controllare periodicamente lo stato della ferita sotto la medicazione e mantenerla pulita</span>\
					</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////	  	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE BAB /////////////////
    if (selectedValue === 'bab') {
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">Per aiutare a cicatrizzare una ferita, un’escoriazione o un’abrasione, puoi provare Euclorina® ProDERMA Crema oppure Euclorina® ProDERMA Spray</div>\
					<div class="box-azzuro">\
						<div class="box-1">Euclorina® ProDERMA Crema ed Euclorina® ProDERMA Spray favoriscono una rapida cicatrizzazione, creando una barriera protettiva contro le aggressioni microbiche e favorendo i processi di rigenerazione tissutale.\
		<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatti per<br><b>tutta la famiglia</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/spray-bambini.png"><span><b>SPRAY</b><br>Adatto ai bambini 0+</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/crema-bambini.png"><span><b>CREMA</b><br>Adatta ai bambini 3+</span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2023/03/proderma-pack.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-pelle/riparazione-cute/">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-pro-spray-3">\
					<div class="box-blu">Un consiglio in più</div>\
					<div class="box-consiglio text-s">La pelle lesionata ha la capacità di attivare in modo naturale un processo di autoriparazione che porta poi alla cicatrizzazione. Questo processo si attiva tutte le volte che la pelle subisce tagli, scottature, escoriazioni, traumi, ustioni, lesioni da freddo o da raggi solari. In presenza di condizioni particolari la cicatrizzazione dei tessuti potrebbe rallentare. È opportuno seguire il consiglio del medico o del farmacista e trattare la ferita con <b>prodotti specifici</b> che creano una <b>barriera protettiva</b> che favorisce una <b>rapida cicatrizzazione</b>.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	/////////////////////////////////////////////////////////////////////////////////////		  
  
		  
	  
	  
    // Aggiorniamo il contenuto dello step successivo
    $('.step-4').html(newContent);	  

  });		
	
	
	
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////// CLICK OPTION STEP 4 -> update content step 5 ////////////////////////////////////////  
  $('#multi-step-form').on('change', '.step-4 input', function(event) {  
	    
	// disabilito avanti
	if ($('.step-4 input[type=radio]:checked').length > 0) {
		$('.step-4 .next-step').prop('disabled', false);
	}    
    // Otteniamo il valore dell'opzione selezionata
    var selectedValue = $(this).val();
    // Creiamo il nuovo contenuto in base alla scelta effettuata dall'utente
    var newContent = '';
	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE AAAA /////////////////
    if (selectedValue === 'aaaa') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">Se le afte sono diffuse ed estese, puoi provare Euclorina® Afte Collutorio</div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Sollievo rapido e duraturo contro le afte dalla 1ª applicazione</p> Euclorina® Afte Collutorio svolge cinque azioni contro le afte: riveste la superficie mucosa creando una barriera che riduce il dolore, la protegge dagli agenti esterni, idrata i tessuti danneggiati favorendo la cicatrizzazione e donando sollievo duraturo dalla prima applicazione.<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/barriera1.png"></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/trattamento.png"><span><b>Trattamento quotidiano protettivo</b></span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatto per<br><b>tutta la famiglia</b></span></div>\
		</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2024/04/AFTE_Collutorio_120m_trequarti_2024.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-afte/#collutorio">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-afte-coll">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">L’<b>alimentazione</b> può essere una valida alleata per prevenire la formazione di afte: <b>frutta, verdura, cereali integrali</b> ma anche <b>bevande e tisane</b> poco zuccherate possono essere un’ottima fonte di vitamine e sali minerali che aiutano la nostra bocca a mantenersi sana.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 
	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE AAAB /////////////////
    if (selectedValue === 'aaab') {		
		newContent = '\
			<div class="ris-quiz-box-full">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">Se le afte sono singole e diffuse, puoi provare Euclorina® Afte Spray </div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Sollievo rapido e duraturo contro le afte dalla 1ª applicazione</p> Euclorina® Afte Spray svolge cinque azioni contro le afte: riveste la superficie mucosa creando una barriera che riduce il dolore, la protegge dagli agenti esterni, idrata i tessuti danneggiati favorendo la cicatrizzazione e donando sollievo duraturo dalla prima applicazione.<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/applicatore.png"><span><b>Applicatore mirato</b> per raggiungere le lesioni anche nelle zone più difficili</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatto per<br><b>tutta la famiglia</b></span></div>\
</div>\
						</div>\
						<div class="box-2"><img src="/wp-content/uploads/2024/04/AFTE_Spray-trequarti_2024_noFlac-1.png"></div>\
						<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-afte/#spray">Scopri di più</a></div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-afte-spray">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">Una scrupolosa e metodica <b>igiene orale</b> e una <b>corretta alimentazione</b> aiutano a ridurre la possibilità di formazione delle afte in bocca. Utilizzare un buono spazzolino con le setole morbide e rimuovere con delicatezza ma con regolarità dopo ogni pasto i residui di cibi, specialmente di quelli acidi o piccanti, può aiutare a prevenire le afte in bocca.</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 	  
	  
	  
	  
	/////////////////// SE SELEZIONO OPZIONE AAAC /////////////////
    if (selectedValue === 'aaac') {		
		newContent = '\
			<div class="ris-quiz-box-full box-v2">\
				<div class="ris-quiz-box-sx">\
					<div class="box-rosso">Se le afte sono singole e piccole, puoi provare Euclorina® Afte Gel</div>\
					<div class="box-azzuro">\
						<div class="box-1"><p>Sollievo rapido e duraturo contro le afte dalla 1ª applicazione</p> Euclorina® Afte Gel svolge cinque azioni contro le afte: riveste la superficie mucosa creando una barriera che riduce il dolore, la protegge dagli agenti esterni, idrata i tessuti danneggiati favorendo la cicatrizzazione e donando sollievo duraturo dalla prima applicazione.<div class="box-loghi">\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/barriera1.png"></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/beccuccio.png"><span><b>Beccuccio di precisione</b> per un\'applicazione mirata per lesioni circoscritte</span></div>\
		<div class="logo-box"><img src="/wp-content/uploads/2023/03/xfamiglia.png"><span>Adatto per<br><b>tutta la famiglia</b></span></div>\
	</div>\
						</div>\
						<div class="box-32">\
							<div class="box-3"><a target="_blank" href="/salute-della-bocca/euclorina-afte/#gel">Scopri di più</a></div>\
							<div class="box-2"><img src="/wp-content/uploads/2024/04/AFTE_Gel_box_8ml_trequarti_2024.png"></div>\
						</div>\
						<div class="facsimile">Fac-simile confezione</div>\
					</div>\
				</div>\
				<div class="ris-quiz-box-dx cons-afte-gel">\
					<div class="box-blu">Un consiglio in più</div><div class="box-consiglio">L’origine e le cause delle afte non è del tutto nota, si fanno però molte ipotesi; ad esempio, pare che lo <b>stress</b> possa favorire la formazione di queste fastidiose lesioni in bocca. Oltre ad adottare rimedi specifici, la prima cosa da fare  è cercare di <b>ridurre i fattori scatenati</b> dello stress</div>\
				</div>\
		    </div>\
			<div class="box-frecce box-frecce-large">\
				<button class="prev-step"><</button>\
				<button class="restart">Torna al test</button>\
			</div>\
			<div class="box-separ"></div>\
			<div class="box-contatto">\
				Il test è stato utile? Per ricevere altri consigli,<br><span class="resta-in">resta in contatto con noi</span>\
				<a href="/contatti/"><img src="/wp-content/uploads/2023/03/freccia-resta.png"></a>\
			</div>\
		';
    } 	  	  
	  
	  
	  
	  
	/////////////////////////////////////////////////////////////////////////////////////
	  
    // Aggiorniamo il contenuto dello step successivo
    $('.step-5').html(newContent);	  

  });		
		
	
	
	
});	
});
		// Función para activar la navegación accesible en el step dado
function activateKeyboardNavigation(step) {
  const options = step.querySelectorAll('.radio-option');
  const nextBtn = step.querySelector('.next-step');
  const prevBtn = step.querySelector('.prev-step');
  const inputName = step.querySelector('input[type="radio"]')?.name;

  if (!options.length || !nextBtn || !inputName) return;

  options.forEach(opt => opt.setAttribute('tabindex', '0'));

  function updateNextButton() {
    const checked = step.querySelector(`input[name="${inputName}"]:checked`);
    if (checked) {
      nextBtn.disabled = false;
      nextBtn.setAttribute('aria-disabled', 'false');
    } else {
      nextBtn.disabled = true;
      nextBtn.setAttribute('aria-disabled', 'true');
    }
  }

  // Seleccionar primera opción si no hay ninguna seleccionada
  if (!step.querySelector(`input[name="${inputName}"]:checked`)) {
    const firstRadio = options[0].querySelector('input[type="radio"]');
    if (firstRadio) {
      firstRadio.checked = true;
      firstRadio.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }

  updateNextButton();

  // Poner foco en el elemento seleccionado o en la primera opción si no hay ninguno seleccionado
  const selectedOption = Array.from(options).find(opt => {
    const radio = opt.querySelector('input[type="radio"]');
    return radio && radio.checked;
  });
  if (selectedOption) {
    selectedOption.focus();
  } else if (options.length > 0) {
    options[0].focus();
  }

  options.forEach((option, index) => {
    option.addEventListener('keydown', e => {
      const key = e.key;

      if (['ArrowRight', 'ArrowDown'].includes(key)) {
        e.preventDefault();
        if (index < options.length - 1) options[index + 1].focus();
        else nextBtn.focus();
      }

      if (['ArrowLeft', 'ArrowUp'].includes(key)) {
        e.preventDefault();
        if (index > 0) options[index - 1].focus();
      }

      if (key === 'Enter' || key === ' ') {
        e.preventDefault();
        const radio = option.querySelector('input[type="radio"]');
        if (radio) {
          radio.checked = true;
          radio.dispatchEvent(new Event('change', { bubbles: true }));
          updateNextButton();
        }
      }
    });

    option.addEventListener('click', () => {
      const radio = option.querySelector('input[type="radio"]');
      if (radio) {
        radio.checked = true;
        radio.dispatchEvent(new Event('change', { bubbles: true }));
        updateNextButton();
      }
    });
  });

  nextBtn.setAttribute('tabindex', '0');
  nextBtn.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      nextBtn.click();
    }
    if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
      e.preventDefault();
      if (prevBtn) prevBtn.focus();
      else options[options.length - 1].focus();
    }
  });

  if (prevBtn) {
    prevBtn.setAttribute('tabindex', '0');
    prevBtn.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        prevBtn.click();
      }
      if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
        e.preventDefault();
        nextBtn.focus();
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('multi-step-form');
  const steps = Array.from(form.querySelectorAll('.step'));
  let currentStepIndex = steps.findIndex(step => step.classList.contains('visible'));

  if (currentStepIndex === -1) currentStepIndex = 0;
  activateKeyboardNavigation(steps[currentStepIndex]);

  form.addEventListener('click', (event) => {
    const nextBtn = event.target.closest('.next-step');
    const prevBtn = event.target.closest('.prev-step');

    if (nextBtn) {
      event.preventDefault();

      steps[currentStepIndex].classList.remove('visible');
      currentStepIndex = Math.min(currentStepIndex + 1, steps.length - 1);
      steps[currentStepIndex].classList.add('visible');

      setTimeout(() => {
        activateKeyboardNavigation(steps[currentStepIndex]);
      }, 50);
    }

    if (prevBtn) {
      event.preventDefault();

      steps[currentStepIndex].classList.remove('visible');
      currentStepIndex = Math.max(currentStepIndex - 1, 0);
      steps[currentStepIndex].classList.add('visible');

      setTimeout(() => {
        activateKeyboardNavigation(steps[currentStepIndex]);
      }, 50);
    }
  });
});





</script>
		



<?php
}
