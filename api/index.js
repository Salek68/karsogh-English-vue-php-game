var data = true;
var i=0;


// // آدرس سمت سرور
// const apiUrl = 'http://localhost/api/api.php';

// // اطلاعاتی که می‌خواهید با POST ارسال کنید
const postData = {
    type:"listclassdabir",
    dabirname:"قربان علی"
};

// // تنظیمات درخواست
const requestOptions = {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(postData),
};

// // ارسال درخواست به سمت سرور
// fetch(apiUrl, requestOptions)
//     .then(response => response.json())
//     .then(data => console.log(data))
//     .catch(error => console.error('خطا در ارسال درخواست:', error));


let apiUrl = 'http://localhost/api/api.php';
let rateLimitError = 'تعداد درخواست‌های شما بیش از حد مجاز است.';

let rateLimit = async () => {
    try {
        let response = await fetch(apiUrl,requestOptions);
        
        if (response.status === 429) {
            console.error(rateLimitError);
            data = false;
        } else {
            let data = await response.json();
            console.log(data); console.log(i)
        }
    } catch (error) {
        console.error('خطا در اجرای درخواست.');
    }
};

rateLimit();
