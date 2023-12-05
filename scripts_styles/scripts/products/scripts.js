let plusButtons = document.querySelectorAll(".plus");
let inputContents = document.querySelectorAll(".quantity");
let minusButtons = document.querySelectorAll(".minus");

for(let i=0;i<plusButtons.length;i++)
{
    plusButtons[i].addEventListener('click',()=>
    {
        inputContents[i].value++;
        if(inputContents[i].value>=50)
        {
            inputContents[i].value = 50;
        }
    });
    minusButtons[i].addEventListener('click',()=>
    {
        inputContents[i].value--;
        if(inputContents[i].value<=0)
        {
            inputContents[i].value = 0;
        }
    });
}