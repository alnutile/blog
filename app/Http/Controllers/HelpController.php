<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use cebe\markdown\GithubMarkdown;
use Laravelista\Sherlock\Sherlock;
use Dompdf\Dompdf;

class HelpController extends Controller
{


    public function show(GithubMarkdown $markdown_writer, Sherlock $sherlock)
    {
        $path = base_path("docs/help.md");
        $help = \File::get($path);
        $toc = $sherlock->deduct($help)->getToc();

        $help = $markdown_writer->parse($help);

        $help = $toc . '<hr>' . $help;

        return view('help', compact("help"));
    }

    public function pdf(GithubMarkdown $markdown_writer, Sherlock $sherlock)
    {
        $path = base_path("docs/help.md");
        $help = \File::get($path);
        $toc = $sherlock->deduct($help)->getToc();

        $help = $markdown_writer->parse($help);

        $help = $toc . '<hr>' . $help;

        return \PDF::loadHTML($help)->stream();
    }
}
