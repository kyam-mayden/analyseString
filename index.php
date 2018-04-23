<?php
$string="<h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pretium efficitur consequat. Vestibulum nec augue suscipit, congue justo vitae, facilisis diam. Duis aliquet a ante eget scelerisque. Vestibulum pharetra at ante quis pellentesque. Sed ac euismod velit. Quisque nec elementum neque, a placerat libero. Cras non arcu sed ipsum semper accumsan sit amet varius lectus. Donec ac odio efficitur, imperdiet mi at, gravida elit. Praesent at est nulla.</h1>
<aside>Fusce tincidunt diam nisl, ut imperdiet diam pretium eget. Mauris aliquam purus eget nunc molestie, nec scelerisque velit bibendum. Suspendisse at pulvinar nisl, et faucibus est. Aenean rutrum consequat orci, eu ornare metus vulputate tempus. Maecenas consequat ornare sapien et rhoncus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer justo enim, ornare at luctus vel, fringilla vel sapien. Integer tristique lectus non libero feugiat, eu consequat ante venenatis.</>
<p>Integer sit amet elit dictum sapien cursus laoreet. Nullam tempus mi eget mauris rutrum, non pellentesque mauris mattis. Cras in tortor quis risus vehicula aliquam. Praesent sed ipsum congue, posuere sem ac, scelerisque mauris. Fusce pellentesque massa ut tellus ultrices, tempus rhoncus augue aliquam. Aenean ultrices dictum lorem eu mollis. Vestibulum venenatis tempor elit sit amet feugiat. Suspendisse lacinia dolor quis nisl dignissim efficitur. In pellentesque ante a egestas rhoncus. Nam mattis eleifend augue quis facilisis. Aenean ullamcorper orci eu quam vulputate iaculis.</p>
<p>Pellentesque in quam dictum turpis laoreet sagittis. Sed in nisl ac lacus condimentum convallis. Duis elementum, neque at eleifend vestibulum, erat massa condimentum lectus, in fringilla ex massa sed est. Cras quis felis quis metus tincidunt condimentum. Etiam id neque quis lacus lobortis eleifend. Cras scelerisque, lorem id consequat ultrices, sapien odio fringilla risus, ac maximus turpis mi in nisi. Duis lacus magna, congue quis est quis, rutrum dapibus nibh. Sed porta neque non libero pellentesque mattis. Curabitur euismod rutrum fringilla. Donec fringilla, ex lacinia fringilla egestas, lacus purus mollis tortor, vitae interdum dolor elit ut sem. Nunc viverra, felis eget vulputate euismod, felis sapien tempor libero, eu bibendum dolor sapien at risus. Sed viverra ornare enim, vitae ullamcorper dui feugiat quis. Nunc aliquam dolor eget finibus feugiat. Donec in turpis bibendum, dapibus metus in, bibendum ex. Maecenas ornare ipsum nunc, vitae finibus enim eleifend sit amet. Nam mauris nulla, rhoncus ut varius et, euismod sit amet leo.</p>
<p>Nulla facilisi. Nam et enim odio. Cras in dolor quis nunc maximus elementum. Etiam vel gravida dui. Pellentesque consectetur dapibus dui imperdiet consequat. Suspendisse fringilla convallis tellus, quis sodales leo egestas a. Mauris placerat fringilla porttitor. Pellentesque placerat vel nisl sagittis dignissim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse ac aliquam ligula, et euismod quam. Cras eget fringilla sapien, a malesuada massa. Etiam quis pulvinar nunc. Mauris faucibus nulla dui, tempus viverra libero accumsan id. Nunc convallis ligula bibendum, aliquam odio non, placerat enim.</p>";


class StringAnalyze {
    public $string;

    /**
     * StringAnalyze constructor.
     * @param $string input string
     */
    function __construct($string) {
        $this->string = $string;
    }

    /**
     * Calculates characters in $string
     *
     * @return string - HTML with character count
     */
    public function CharacterCount():string {
        $length= strlen($this->string);
        return "<p>characters: $length.</p>";
    }

    /**
     * Counts amount of words in a string
     *
     * @return string - HTML with word count
     */
    public function WordCount():string {
        $words= str_word_count($this->string);
        return "<p>words: $words.</p>";
    }

    /**
     * Counts amount of sentences
     *
     * @return string - HTML with sentence count
     */
    public function Sentences():string {
        $sentences = substr_count($this->string, '.');
        return "<p>sentences: $sentences.</p>";
    }

    /**
     * Counts number of paragraphs using HTML tags as reference
     *
     * @return string - HTML with paragraph count
     */
    public function Paragraphs():string {
        $paragraphs = substr_count($this->string, '</');
        return "<p>There are $paragraphs paragraphs.</p>";
    }

    /**
     * Strips HTML tags and punctuation from $string
     *
     * @param $string input string at constructor
     *
     * @return array - all words stripped
     */
    private function GetWords($string):array {
        $string = str_replace(".", " ", $string);
        $string = str_replace(",", " ", $string);
        $string = str_replace("!", " ", $string);
        $string = str_replace(">", " ", $string);
        $string = str_replace("<", " ", $string);
        $words = explode(' ', $string);
        return $words;
    }

    /**
     * Calculates longest word and its length
     *
     * @return string - HTML with longest word and length
     */
    public function LongestWord():string {
        $words = $this->GetWords($this->string);
        $longestWord='';
        $longestLength=0;
        foreach ($words as $word) {
            if (strlen($word) > $longestLength){
                $longestWord = $word;
                $longestLength = strlen($word);
            }
        }
        return "<p>Longest word is '$longestWord' at $longestLength characters.</p>";
    }

    /**
     * Calculates average sentence length
     *
     * @return string = HTML with mean, median and mode averages
     */
    public function AvgSentenceLength():string {
        $array = explode('.', $this->string);
        $lengths = array_map('strlen', $array);
        $mode= array_keys(array_count_values($lengths))[0];
        $mean = round((array_sum($lengths)/sizeof($lengths)));
        sort($lengths);
        $median = $lengths[ceil(count($lengths)/2)];
        return "<p>The mean sentence length is $mean, the mode is $mode and the median value is $median.</p>";
    }

}

$object = new stringAnalyze($string);

echo $object->string;
echo $object->CharacterCount();
echo $object->WordCount();
echo $object->Sentences();
echo $object->Paragraphs();
echo $object->LongestWord();
echo $object->AvgSentenceLength();


