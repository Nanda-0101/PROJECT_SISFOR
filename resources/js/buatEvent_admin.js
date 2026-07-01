document.addEventListener("DOMContentLoaded",()=>{

    let jenis=document.getElementById("jenis_event");

    let biaya=document.getElementById("biaya");

    jenis.addEventListener("change",()=>{

        if(jenis.value==="gratis"){

            biaya.value=0;

            biaya.readOnly=true;

        }else{

            biaya.readOnly=false;

        }

    });

});