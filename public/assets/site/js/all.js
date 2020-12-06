
function convertFromBigha(t) {
    bigha=$("#bigha").val(),
    kathha=$("#kathha").val(),
    dhur=$("#dhur").val(),
    total_dhur=400*bigha+20*kathha+1*dhur,
    total_sqft=182.25*total_dhur,
    convertFromTotalSqft(total_sqft,t)
}

function convertFromRopani(t){ 
    ropani=$("#ropani").val(),
    aana=$("#aana").val(),
    paisa=$("#paisa").val(),
    dam=$("#dam").val(),
    total_paisa=64*ropani+4*aana+1*paisa+dam/4,
    total_sqft=85.56*total_paisa,
    convertFromTotalSqft(total_sqft,t)
}

function convertFromSqMt(t) { 
    sqmt=$("#squareMeter").val(),
    total_sqft=sqmt/.092903,
    convertFromTotalSqft(total_sqft,t)
}

function convertFromSqFt(t){
    total_sqft=$("#squareFeet").val(),
    total_sqft*=1,
    convertFromTotalSqft(total_sqft,t)
}

function convertFromTotalSqft(t,e) { 
    total_sqmt=.092903*t,
    total_paisa=t/85.56,
    total_dhur=t/182.25,
    ropaniPart=Math.floor(total_paisa/64),
    remainingPaisa=total_paisa-64*ropaniPart,
    aanaPart=Math.floor(remainingPaisa/4),
    remainingPaisa-=4*aanaPart,
    paisaPart=Math.floor(remainingPaisa),
    remainingPaisa-=paisaPart,
    damPart=4*remainingPaisa,
    bighaPart=Math.floor(total_dhur/400),
    remainingDhur=total_dhur-400*bighaPart,
    kathhaPart=Math.floor(remainingDhur/20),
    remainingDhur-=20*kathhaPart,
    dhurPart=remainingDhur,
    "np"==e?(ropaniText=" à¤°à¥‹à¤ªà¤¨à¥€ ",
    aanaText=" à¤†à¤¨à¤¾ ",
    paisaText=" à¤ªà¥ˆà¤¸à¤¾ ",
    damText=" à¤¦à¤¾à¤® ",
    bighaText=" à¤¬à¤¿à¤—à¤¾ ",
    kathhaText=" à¤•à¤ à¥à¤ à¤¾ ",
    dhurText=" à¤§à¥à¤° ",
    sqmtText=" à¤µà¤°à¥à¤— à¤®à¤¿à¤Ÿà¤° ",
    sqftText=" à¤µà¤°à¥à¤— à¤«à¤¿à¤Ÿ ") :
    (ropaniText=" Ropani ",
    aanaText=" Aana ",
    paisaText=" Paisa ",
    damText=" Dam ",
    bighaText=" Bigha ",
    kathhaText=" Kathha ",
    dhurText=" Dhur ",
    sqmtText=" Square Meter ",
    sqftText=" Square Feet "),
    ropaniResult=ropaniPart+ropaniText+aanaPart+aanaText+paisaPart+paisaText+damPart.toFixed(4)+damText,bighaResult=bighaPart+bighaText+kathhaPart+kathhaText+dhurPart.toFixed(4)+dhurText,squareFeetResult=t.toFixed(4)+sqftText,squareMeterResult=total_sqmt.toFixed(4)+sqmtText,
    $("#ropaniResult").html(ropaniResult),$("#bighaResult").html(bighaResult),$("#squareFeetResult").html(squareFeetResult),$("#squareMeterResult").html(squareMeterResult)
}