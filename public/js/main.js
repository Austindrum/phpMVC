var items          = [...document.querySelectorAll('.item')];
var priceDetail    = document.querySelector('.price-detail');
var itemSelect     = document.querySelectorAll('.itemSelect');
var moreImage      = document.querySelectorAll('.moreImage');
var images         = document.getElementById('images');

moreImage.forEach(btn =>{
    btn.addEventListener('click', function(e){
        e.preventDefault();
        let newFileInput = document.createElement('INPUT');
        newFileInput.setAttribute("type", "file");
        newFileInput.setAttribute("name", "image[]");
        newFileInput.setAttribute("class", "form-control mb-2");
        e.target.insertAdjacentElement("beforebegin", newFileInput);
    });
})


items.forEach(item=>{
    item.addEventListener('click', function(e){
        e.stopPropagation();
        let targetNum = this.children[0].children[0].children[0].children[2].children[0].children[1];
        let toIntTargetNum = parseInt(targetNum.value);
        let targetPrice = parseInt(this.children[0].children[0].children[0].children[1].children[2].innerText.split('$')[1]);
        let itemPriceCount = priceDetail.children[0];
        let totalPrice = priceDetail.children[3];
        if(e.target.classList.contains('plus')){
            let tempItemPriceCount = parseInt(itemPriceCount.innerText) + targetPrice;
            let tempTotalPrice = parseInt(totalPrice.innerText) + targetPrice;
            let plusNum = toIntTargetNum + 1;
            targetNum.value = plusNum;
            itemPriceCount.innerText = tempItemPriceCount;
            totalPrice.innerText = tempTotalPrice;
            priceDetail.children[4].value = parseInt(priceDetail.children[4].value) + targetPrice;
            itemSelect.forEach( item =>{
                if(item.dataset.id === this.dataset.id){
                    let num = parseInt(item.value);
                    item.value = num + 1;
                }
            })
        }
        if(e.target.classList.contains('minus')){
            if(toIntTargetNum > 1){
                let tempItemPriceCount = parseInt(itemPriceCount.innerText) - targetPrice;
                let tempTotalPrice = parseInt(totalPrice.innerText) - targetPrice;
                let minusNum = toIntTargetNum - 1;
                targetNum.value = minusNum;
                itemPriceCount.innerText = tempItemPriceCount;
                totalPrice.innerText = tempTotalPrice;
                priceDetail.children[4].value = parseInt(priceDetail.children[4].value) - targetPrice;
            }else{
                return false;
            }
        }
    })
});


