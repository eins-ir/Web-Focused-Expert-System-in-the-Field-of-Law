function chatBot() {
	
	// current user input
	this.input;
	
	this.list = {
		наследство: "",
		доля: "",
		увольнение: "",
		иск: ""
		
	}
	
	
	/**
	 * respondTo
	 * 
	 * return nothing to skip response
	 * return string for one response
	 * return array of strings for multiple responses
	 * 
	 * @param input - input chat string
	 * @return reply of chat-bot
	 */
	this.respondTo = function(input) {
	
		this.input = input.toLowerCase();
		
		if(this.match('(наследство|наследства|наследования|наследстве)')){
			this.list.наследство = "да";
			return "Вы хотите расчитать долю наследства?";
		}
		if ((this.list.наследство == "да") && (this.list.доля == "")){
			console.log(this.list.наследство);
			console.log(this.list.доля);
			if (this.input == "да"){
				this.list.доля = "да";
				document.location.href = "../inheritancePage.html";
			}
			else{
				this.list.доля = "нет";
				return "Вы хотите составить иск?";
			}
		}
		if ((this.list.наследство == "да") && (this.list.доля == "нет") && (this.list.иск == ""))
			document.location.href = "../lawsuit.html";
		
		
		if(this.match(('(увольнение|уволили|уволить|уволилась)') && this.match('(меня|я)')) || (this.match('(увольнение|уволили)')))
			 document.location.href = "../shemas/sacking/sacking2/sacking.html";
		 
		if ((this.match('(составить|составлять)') && this.match('(иск|иски)')))
			document.location.href = "../lawsuit.html";
		
		if((this.match('(баланс|счет|баланса|счета)') && this.match('(телефон|телефона|мобильный|мобильного)')) || ((this.match('(сняли|снятие)')) && (this.match('(денег|суммы|деньги|сумму)')) && (this.match('(на)')) && (this.match('(телефоне|мобильном|номере|телефона|мобильный|номер|)'))))
			 document.location.href = "../phoneproblem/phone.html";
			 
		if(this.match(('(посылка|почта|почте|посылке)')) || ((this.match('(почтовое|почтовых|почтового)')) && (this.match('(отправление|отправления|отправлений|)'))) || ((this.match('(нет|долго|не)')) && (this.match('(посылки|отдают|отправляет|идет|идёт)'))))
			 document.location.href = "../mailproblem/mail.html";
		
		if(this.input == 'noop')
			return;
		
		return "Данная область еще находится в разработке или Вы ввели некорректный вопрос.";
	}
	
	
	
	/**
	 * match
	 * 
	 * @param regex - regex string to match
	 * @return boolean - whether or not the input string matches the regex
	 */
	this.match = function(regex) {
	
		return new RegExp(regex).test(this.input);
	}
}