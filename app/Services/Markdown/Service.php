<?php
namespace App\Services\Markdown;

//use League\CommonMark\Converter;
//use League\CommonMark\DocParser;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Environment\Environment;
//use League\CommonMark\HtmlRenderer;
use League\CommonMark\Renderer\HtmlRenderer;
//use Webuni\CommonMark\AttributesExtension\AttributesExtension;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\MarkdownConverter;

class Service
{
    protected $markdown;

    public function __construct()
    {
        //dd(Environment::class);
        $environment = Environment::createCommonMarkEnvironment();
        //dd($environment);

        $environment->addExtension(new AttributesExtension());

        $this->markdown = new MarkdownConverter($environment
        );

        
    }

    public function convert($markdown)
    {
        //dd($this->markdown->convert($markdown));
        return $this->markdown->convert($markdown);
    }
}
