<div id="editor-wrapper">
        <div id="formatting-container">
          <select title="Font" class="ql-font">
            <option value="sans-serif" selected>Sans Serif</option>
            <option value="Georgia, serif">Serif</option>
            <option value="Monaco, 'Courier New', monospace">Monospace</option>
          </select>
          <select title="Size" class="ql-size">
            <option value="10px">Small</option>
            <option value="13px" selected>Normal</option>
            <option value="18px">Large</option>
            <option value="32px">Huge</option>
          </select>
          <select title="Text Color" class="ql-color">
            <option value="rgb(255, 255, 255)">White</option>
            <option value="rgb(0, 0, 0)" selected>Black</option>
            <option value="rgb(255, 0, 0)">Red</option>
            <option value="rgb(0, 0, 255)">Blue</option>
            <option value="rgb(0, 255, 0)">Lime</option>
            <option value="rgb(0, 128, 128)">Teal</option>
            <option value="rgb(255, 0, 255)">Magenta</option>
            <option value="rgb(255, 255, 0)">Yellow</option>
          </select>
          <select title="Background Color" class="ql-background">
            <option value="rgb(255, 255, 255)" selected>White</option>
            <option value="rgb(0, 0, 0)">Black</option>
            <option value="rgb(255, 0, 0)">Red</option>
            <option value="rgb(0, 0, 255)">Blue</option>
            <option value="rgb(0, 255, 0)">Lime</option>
            <option value="rgb(0, 128, 128)">Teal</option>
            <option value="rgb(255, 0, 255)">Magenta</option>
            <option value="rgb(255, 255, 0)">Yellow</option>
          </select>
          <select title="Text Alignment" class="ql-align">
            <option value="left" selected>Left</option>
            <option value="center">Center</option>
            <option value="right">Right</option>
            <option value="justify">Justify</option>
          </select>
          <div id="textB" title="Bold" class="ql-format-button ql-bold">Bold</div>
          <div id="textB" title="Italic" class="ql-format-button ql-italic">Italic</div>
          <div id="textB" title="Underline" class="ql-format-button ql-underline">Under</div>
          <div id="textB" title="Strikethrough" class="ql-format-button ql-strike">Strike</div>
          <!--<div id="textB" title="Link" class="ql-format-button ql-link">Link</div>-->
          <div id="textB" title="Image" class="ql-format-button ql-image">Image</div>
          <div id="textB" title="Bullet" class="ql-format-button ql-bullet">Bullet</div>
          <div id="textB" title="List" class="ql-format-button ql-list">List</div>
        </div>
        <div id="editor-container"></div>
      </div>
    <script type="text/javascript" src="script/quill.js"></script>
    <script type="text/javascript">
      var editor = new Quill('#editor-container', {
        modules: {
          'toolbar': { container: '#formatting-container' },
          'link-tooltip': true,
          'image-tooltip': true
        }
      });
      editor.on('selection-change', function(range) {
        console.log('selection-change', range)
      });
      editor.on('text-change', function(delta, source) {
        console.log('text-change', delta, source)
      });
    </script>