<?php
	abstract class AbstractPageTemplate {
		protected final function template() {
			$result = "";
			$result .= $this->header();
			$result .= $this->body();
			$result .= $this->footer();
			return $result;
		}
		
		protected abstract function header();
		protected abstract function body();
		protected abstract function footer();
		
		public function render() {
			return $this->template();
		}
	}
	
	class TextPage extends AbstractPageTemplate {
		protected function header() {
			return "PHP\n";
		}
		
		protected function body() {
			return "PHP: Hypertext Preprocessor\n";
		}
		
		protected function footer() {
			return "website is php.net\n";
		}
	}
	
	class HtmlPage extends AbstractPageTemplate {
		protected function header() {
			return "<header>PHP</header>\n";
		}
		
		protected function body() {
			return "<article>PHP: Hypertext Preprocessor</article>\n";
		}
		
		protected function footer() {
			return "<footer>website is php.net</footer>\n";
		}
		
		public function render() {
			//$result = $this->template();
			$result = parent::template();
			return "<html>" . $result . "</html>";
		}
	}
	
	// json
	// markdown
	
	echo "<h1>text</h1>";
	$text = new TextPage();
	echo $text->render();
	
	echo "<h1>html</h1>";
	$html = new HtmlPage();
	echo $html->render();
?>
