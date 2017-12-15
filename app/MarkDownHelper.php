<?php
/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/29/2016
 * Time: 7:11 PM
 */

namespace App;

/**
 * @codeCoverageIgnore
 * just a getter setter
 */
trait MarkDownHelper
{
    
    protected $markdown_tool = null;

    /**
     * @return MarkdownExtraParser
     */
    public function getMarkdownTool()
    {
        if ($this->markdown_tool == null) {
            $this->setMarkdownTool();
        }
        
        return $this->markdown_tool;
    }

    /**
     * @param null $markdown_tool
     */
    public function setMarkdownTool($markdown_tool = null)
    {
        if ($markdown_tool == null) {
            $markdown_tool = new \App\MarkdownExtraParser();
        }
        
        $this->markdown_tool = $markdown_tool;
    }
}
