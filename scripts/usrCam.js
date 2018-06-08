function activeXHR()
{
	var xhr;

	if (window.ActiveXObject)
	{
		try
		{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	else if (window.XMLHttpRequest)
		xhr = new XMLHttpRequest();
	else
	{
		alert("Your web browser do not support XMLHttpRequest");
		return null;
	}
	return xhr;
}

function postImg(content, index)
{
	var xhr = activeXHR();

	content = encodeURIComponent(content);

	if (xhr)
	{
		xhr.open("POST", "/index.php?action=postPic", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("camContent="+content+'&'+"filterPath="+index);
	}
}

const constraints = {
  video: true
};

// function	addFilter(index)
// {
// 	// document.getElementById('buttonSnap').disabled = false;
// 	on_elm.style.background = index;
// 	on_elm.style.display = "block";
// 	on_elm.style.backgroundRepeat = "no-repeat";
// 	on_elm.style.backgroundSize=  "320px 240px";
// 	on_elm.setAttribute("id", index+"s");
// 	on_elm.style.left = "680px";
// 	on_elm.style.top = "350px";
// 	return on_elm;
// }


const button = document.querySelector('#screenshot-button');
const img = document.querySelector('#screenshot-img');
const video = document.querySelector('#screenshot-video');
const canvas = document.createElement('canvas');
const filt = document.querySelector('#filter');
// var on_elm = document.getElementById("#screenshot-img");

var select, getImg;
const width = 400;
var height = 0;

button.addEventListener("click", function()
	{
		// document.getElementById('filter').src);
		(document.getElementById('filter_fix').src=document.getElementById('filter').src);
		canvas.width = width;
		height = video.videoHeight / (video.videoWidth/width);
		canvas.height = height;
		ctx = canvas.getContext('2d');
		ctx.drawImage(video, 0, 0, width, height);
		img.src = canvas.toDataURL('image/png');
		if (!document.getElementById('keep-it'))
		{
			select = '<button id="keep-it">Garder cette photo</a>';
			document.getElementById('buttons').innerHTML += select;
		}
		keepit(img.src.split(',')[1], document.getElementById('filter_fix').src);
	}
);

function keepit(content, index)
{
	var keep = document.getElementById('keep-it');

	keep.addEventListener("click", function()
		{
			postImg(content, index);
		}
	);
}


function handleSuccess(stream) {
	video.srcObject = stream;
}
function handleError(error) {
	console.error('Reeeejected!', error);
}

navigator.mediaDevices.getUserMedia(constraints).
then(handleSuccess).catch(handleError);