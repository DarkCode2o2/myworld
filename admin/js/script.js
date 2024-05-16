let message = document.querySelectorAll('.msg');
        
message.forEach((element) => 
   setTimeout(() => {
        element.style.display = 'none';
   }, 3000)
)