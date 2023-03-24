<?php
class statistiques
{
    private const PARAMS_EXPLODE = [',', ' ', '.', ')', '('];

    private array $mots_inutiles;
    private array $nb_mots_phrase;
    private array $occurences = [];
    private array $phrase_page;

    private string $contenu = '';
    private string $type;


    public function __construct()
    {
        $this->mots_inutiles = explode("\r\n", trim(file_get_contents(dirname(__FILE__) . '/mots_inutiles.txt')));
        $this->contenu = get_the_content();
        $this->computeType();
    }

    public function computeStats()
    {
        $this->lengthSentences();
        $this->frequencylistW();
    }

    private function computeType()
    {
        switch (get_post_type()) {
            case 'page':
                $this->type = "la page";
                break;
            case 'post':
                $this->type = "l'article";
                break;
            default:
                $this->type = 'inconnu';
                break;
        }
    }

    private function  lengthSentences()
    {
        $this->phrase_page = explode('.', $this->contenu);
        $this->nb_mots_phrase = array_fill(0, count($this->phrase_page), 0);
        foreach ($this->phrase_page as $id => $phrase) {
            $mots = explode(' ', $phrase);
            foreach ($mots as $mot) {
                if (in_array($mot, $this->mots_inutiles)) {
                    continue;
                }
                $this->nb_mots_phrase[$id]++;
            }
        }
        arsort($this->nb_mots_phrase, SORT_NUMERIC);
    }

    private function frequencylistW()
    {
        $mots_page = multiexplode(
            self::PARAMS_EXPLODE,
            $this->contenu
        );

        foreach ($mots_page as $mot) {
            if (
                in_array(strtolower($mot), $this->mots_inutiles)
                or empty(trim($mot))
            ) {
                continue;
            }
            $this->occurences[$mot] = $this->occurences[$mot] ?? 0;
            $this->occurences[$mot]++;
        }
        arsort($this->occurences, SORT_NUMERIC);
    }

    private function topTenWords()
    {
        $i = 1;
        foreach ($this->occurences as $mot => $nbOccurence) {
            echo "$mot ($nbOccurence), ";
            if ($i == 10) break;
            $i++;
        }
    }

    private function topTenSentence()
    {
        foreach ($this->nb_mots_phrase as $phrase => $nbr) {
            $s = '';
            if ($nbr > 1)
                $s  = 's';
            echo "La phrase #$phrase a $nbr mot$s.<br />";
        }
    }

    public function afficherStats()
    {
        $lenContent = mb_strlen($this->contenu);
        if ($lenContent == 0)
            return 'Le texte est vide';

        echo "<div id='stats'>Ici les statistiques de $this->type !<br /><br >
        - Longueur du contenu : " .  $lenContent . "<br />
        - Les 10 mots les plus utilisés de $this->type<br />";

        $this->topTenWords();

        echo '<br />';

        echo 'Top des phrases les plus longues :<br />';

        echo $this->topTenSentence();

        echo " Une phrase au hasard :
        {$this->phrase_page[array_rand($this->phrase_page)]}
        <br /></div>
        <input type='submit' id='boutonCacher' name='boutonCacher' value='Afficher/Masquer les statistiques'/>
        ";
    }

    public function jsButton()
    {
        echo
        "<script>
        function showHideB() {
            if (stats.style.display == 'none') {
                stats.style.display = 'block';
            } else {
                stats.style.display = 'none';
            }
        }
        document.getElementById('boutonCacher').addEventListener('click', showHideB);
        </script>";
    }
}
