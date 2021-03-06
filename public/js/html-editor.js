var htmlEditor = CodeMirror(document.getElementById("htmlEditor"),{
    value: lessonPromptHTML,
    mode: "htmlmixed",
    // htmlMode: true,
    theme: "shadowfox",
    tabSize: 2,
	lineNumbers: true,
	lineWrapping: true,
    extraKeys: {"Ctrl-Space": "autocomplete"}
});


var output = htmlEditor.getValue();
function executeCodeHTML(){
    var text = htmlEditor.getValue();
    var ifr = document.createElement("iframe");
    ifr.setAttribute("frameborder", "0");
    ifr.setAttribute("id", "iframeOutput");  
    document.getElementById("iframewrapper").innerHTML = "";
    document.getElementById("iframewrapper").appendChild(ifr);
    var ifrw = (ifr.contentWindow) ? ifr.contentWindow : (ifr.contentDocument.document) ? ifr.contentDocument.document : ifr.contentDocument;
    ifrw.document.open();
    ifrw.document.write(text);
    ifrw.document.close();
};
executeCodeHTML(); 
htmlEditor.refresh();
/* ANSWER KEY STARTS HERE */
var html1_ans = "<!DOCTYPE html>\n<html>\n\t<body>\n\t\t<h1>Hello World</h1>\n\t</body>\n</html>";
var html2_ans = "<p>Wrap me in a paragraph tag!</p>";
