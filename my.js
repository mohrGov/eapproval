
<!--- Begin
var CurrentMsg = 'hello ';                    
function update(msg) {                           
var pad_str="";                           
n = msg.length;                           
if(n<72) {                                   
pad = (73-n)/2;                                   
for(var i=0; i<pad; i++) {                                           
pad_str+=" ";                        
   }                        
}                          
CurrentMsg = pad_str + msg;                           
document.messages.field.value = CurrentMsg;
clearTimeout(timer);                           
timer = setTimeout("idleMsg()",3000);        
}                           
function MakeArray(n) {                           
this.length=n;                           
for(var i = 1; i<= n; i++) {                                   
this[i] = "";                
}                           
return(this);        
}               
var index = 1;           
var notice_num = 8;                   
var notices = new MakeArray(notice_num);        
notices[1] = "Sistem Ini Berfungsi Bagi Proses Permohonan Dan Proses Kelulusan Ke Luar Negara";        
notices[2] = "Sistem Ini Dibangunkan Berasaskan Web, Oleh Itu Proses Capaian Boleh Dibuat Dimana-mana Sahaja";
notices[3] = "Log Masuk Adalah  Menggunakan Id Dan Katalaluan Seperti Email Rasmi";        
          
var timer = setTimeout('idleMsg()',100);                   
function nochange() {                           
document.messages.field.value = CurrentMsg;        
}                   
function idleMsg() {                           
update(notices[index++]);                           
if(index>notice_num) { 
index=1; 
   }  
}
// End -->     