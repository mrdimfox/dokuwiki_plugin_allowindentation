<?php
/**
 * Allow Indentation DokuWiki Plugin (Syntax Component)
 *
 * Allow using an indentation in wiki text and disable a rendering indented
 * blocks as a preformatted text.
 *
 * @license MIT https://opensource.org/licenses/MIT
 * @author  Lisin Dmitriy <mrlisdim@gmail.com>
 */


if (!defined('DOKU_INC')) {
    die();
}


class syntax_plugin_allowindentation extends DokuWiki_Syntax_Plugin
{
    /**
     * @return string Syntax mode type
     */
    function getPType()
    {
        return 'normal';
    }

    /**
     * @return string Paragraph type
     */
    public function getType()
    {
        return 'container';
    }

    /**
     * Allow all possible types
     */
    function getAllowedTypes()
    {
        return array (
            'container',
            'substition',
            'protected',
            'disabled',
            'formatting',
            'paragraphs',
            'baseonly'
        );
    }

    /**
     * Priority less than `preformatted`
     * @return int Sort order - Low numbers go before high numbers
     */
    public function getSort()
    {
        return 19;
    }

    /**
     * Connect pattern to lexer
     *
     * Catch all preformatted entries to prevent them from rendering as
     * `<pre>`.
     *
     * @param string $mode Parser mode
     */
    public function connectTo($mode)
    {
        $this->Lexer->addSpecialPattern('\n  (?![\*\-])', $mode, 'plugin_allowindentation');
        $this->Lexer->addSpecialPattern('\n\t(?![\*\-])', $mode, 'plugin_allowindentation');
    }

    /**
     * Do nothing in this plugin.
     */
    function postConnect() { }

    /**
     * Handle matches of the allowindentation syntax
     * 
     * Return nothing to handle it in `render`.
     *
     * @param string       $match   The match of the syntax
     * @param int          $state   The state of the handler
     * @param int          $pos     The position in the document
     * @param Doku_Handler $handler The handler
     *
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, Doku_Handler $handler)
    {
        return array();
    }

    /**
     * Render xhtml output or metadata
     * 
     * Actually prevent any rendering in this plugin.
     *
     * @param string        $mode     Renderer mode (supported modes: xhtml)
     * @param Doku_Renderer $renderer The renderer
     * @param array         $data     The data from the handler() function
     *
     * @return bool If rendering was successful.
     */
    public function render($mode, Doku_Renderer $renderer, $data)
    {
        return false;
    }
}
