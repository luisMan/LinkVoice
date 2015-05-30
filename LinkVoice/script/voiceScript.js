console.log("voice got called");
var voice = new WebSpeechRecognition();
voice.statusText('status');
voice.statusImage('status_img');
voice.finalResults('editor-container');
voice.continuous = true;
voice.interimResults = true;
voice.maxAlternatives = 1;



// Handler when user clicks microphone button.
voice.MicToggleButton = function() {
  

  voice.lang = select_dialect.value;
  voice.toggleStartStop();
}

var create_post_on_end = false;

voice.onEnd = function() {
  if (create_post_on_end) {
    create_post_on_end = false;
    createPost(voice.final_transcript);
  }
  console.log("just finished");
  var text =  $("#editor-container").html();
   $("#content-container").load("script/editor.php");
   $("#editor-container").html(text);
    $("#editor-container").val("jjhjhkjh fgfgh");
};

// Handler when user clicks "Create Email" button.
voice.postButton = function() {
  if (voice.inProgress()) {
    // Wait for recognition to end before calling createEmail().
    create_post_on_end= true;
    voice.stop();
  } else {
    // Recognition has already ended, call createEmail() now.
    createPost(voice.final_transcript);
  }
  voice.onState('complete');
}

// Create email by splitting string s into subject and body.
function createPost(s) {
  // Determine a good place to split it: end of first line, else at a space.
  var n = s.indexOf('\n');
  if (n < 0 || n >= 80) {
    n = 40 + s.substring(40).indexOf(' ');
  }
  var subject = encodeURI(s.substring(0, n));
  var body = encodeURI(s.substring(n + 1));
  // Open default email provider.
  window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
}

var langs =
[['Afrikaans',       ['af-ZA']],
 ['Bahasa Indonesia',['id-ID']],
 ['Bahasa Melayu',   ['ms-MY']],
 ['Català',          ['ca-ES']],
 ['Čeština',         ['cs-CZ']],
 ['Deutsch',         ['de-DE']],
 ['English',         ['en-AU', 'Australia'],
                     ['en-CA', 'Canada'],
                     ['en-IN', 'India'],
                     ['en-NZ', 'New Zealand'],
                     ['en-ZA', 'South Africa'],
                     ['en-GB', 'United Kingdom'],
                     ['en-US', 'United States']],
 ['Español',         ['es-AR', 'Argentina'],
                     ['es-BO', 'Bolivia'],
                     ['es-CL', 'Chile'],
                     ['es-CO', 'Colombia'],
                     ['es-CR', 'Costa Rica'],
                     ['es-EC', 'Ecuador'],
                     ['es-SV', 'El Salvador'],
                     ['es-ES', 'España'],
                     ['es-US', 'Estados Unidos'],
                     ['es-GT', 'Guatemala'],
                     ['es-HN', 'Honduras'],
                     ['es-MX', 'México'],
                     ['es-NI', 'Nicaragua'],
                     ['es-PA', 'Panamá'],
                     ['es-PY', 'Paraguay'],
                     ['es-PE', 'Perú'],
                     ['es-PR', 'Puerto Rico'],
                     ['es-DO', 'República Dominicana'],
                     ['es-UY', 'Uruguay'],
                     ['es-VE', 'Venezuela']],
 ['Euskara',         ['eu-ES']],
 ['Français',        ['fr-FR']],
 ['Galego',          ['gl-ES']],
 ['IsiZulu',         ['zu-ZA']],
 ['Íslenska',        ['is-IS']],
 ['Italiano',        ['it-IT', 'Italia'],
                     ['it-CH', 'Svizzera']],
 ['Magyar',          ['hu-HU']],
 ['Nederlands',      ['nl-NL']],
 ['Norsk bokmål',    ['nb-NO']],
 ['Polski',          ['pl-PL']],
 ['Português',       ['pt-BR', 'Brasil'],
                     ['pt-PT', 'Portugal']],
 ['Română',          ['ro-RO']],
 ['Slovenčina',      ['sk-SK']],
 ['Suomi',           ['fi-FI']],
 ['Svenska',         ['sv-SE']],
 ['Türkçe',          ['tr-TR']],
 ['български',       ['bg-BG']],
 ['Pусский',         ['ru-RU']],
 ['Српски',          ['sr-RS']],
 ['한국어',            ['ko-KR']],
 ['中文',             ['cmn-Hans-CN', '普通话 (中国大陆)'],
                     ['cmn-Hans-HK', '普通话 (香港)'],
                     ['cmn-Hant-TW', '中文 (台灣)'],
                     ['yue-Hant-HK', '粵語 (香港)']],
 ['日本語',           ['ja-JP']],
 ['Lingua latīna',   ['la']]];

function updateCountry() {
  for (var i = select_dialect.options.length - 1; i >= 0; i--) {
    select_dialect.remove(i);
  }
  var list = langs[select_language.selectedIndex];
  for (var i = 1; i < list.length; i++) {
    select_dialect.options.add(new Option(list[i][1], list[i][0]));
  }
  select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
}

for (var i = 0; i < langs.length; i++) {
  select_language.options[i] = new Option(langs[i][0], i);
}
select_language.selectedIndex = 6;
updateCountry();
select_dialect.selectedIndex = 6;