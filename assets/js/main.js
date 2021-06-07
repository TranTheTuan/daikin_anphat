let blockClassName = ['ft-block-name', 'func-block-name', 'fo-block-name'];
let blockClassContent = ['ft-block-content', 'func-block-content', 'fo-block-content'];

function calculateBlockHeight(blockList) {
    for(let block of blockList) {
        let blocksByClass = document.getElementsByClassName(block);
        let numOfEleInBlock = document.getElementsByClassName(block).length;
        if (numOfEleInBlock <= 1) {
            return;
        }
        for(let i = 0; i < numOfEleInBlock; i += 2) {
            let left = blocksByClass[i].offsetHeight;
            let right = blocksByClass[i+1].offsetHeight;
            if(left > right) {
                blocksByClass[i+1].style.height = left + "px";
            } else {
                blocksByClass[i].style.height = right + "px";
            }
        }
    }
}

calculateBlockHeight(blockClassContent);
calculateBlockHeight(blockClassName);
