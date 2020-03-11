var items          = [...document.querySelectorAll('.item')];
var priceDetail    = document.querySelector('.price-detail');


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


