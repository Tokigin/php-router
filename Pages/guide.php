<section class="container">
    <h1 id="php-router-cannel-">Php Router (Cannel)</h1>
    <p>Easy to use php router with auto and manual routing.</p>
    <h2 id="-project-structure">📁 Project Structure</h2>
    <pre><code class="lang-text">/
├── Cannel/
├── Components/
│   └── hero-banner.php/
├── Layout/
│   └── <span class="hljs-number">404.</span>html/
│   └── <span class="hljs-number">404.</span>php/
│   └── Footer.php/
│   └── Header.php/
├── Pages/
├── .htaccess/
├── index.php/
├── ManualRouter.php/
└── Setting.php/
</code></pre>
    <p><code>Cannel</code> looks for <code>.php</code> or <code>.html</code> files in the <code>Pages/</code> directory. Each page is exposed as a route based on its file name. To use <code>.html</code> files, switch extension in Setting.php.</p>
    <p>There&#39;s nothing special about <code>Sections/</code>, it is just for sake of clear project structure. You can delete the folder or create one as you like.</p>
    <p><code>Layout/</code> is for header, footer and 404 pages.</p>
    <p><code>Cannel/</code> is the source folder for routing functions. You don&#39;t need to make changes here.</p>
    <h2 id="-setting-php">🛠️ Setting.php</h2>
    <p><code>Setting.php</code> is for configuring the <code>Cannel</code> source code.</p>
    <h3 id="change-home-page">Change Home page</h3>
    <pre><code class="lang-text">Router::$Home_Page = <span class="hljs-string">"home"</span>;
</code></pre>
    <h3 id="remove-header-on-all-pages">Remove header on all pages</h3>
    <pre><code class="lang-text">Layout::$Header = <span class="hljs-literal">false</span>;
</code></pre>
    <h3 id="remove-footer-on-all-pages">Remove footer on all pages</h3>
    <pre><code class="lang-text">Layout::$Footer = <span class="hljs-literal">false</span>;
</code></pre>
    <h3 id="remove-header-in-specific-page">Remove Header in Specific page</h3>
    <pre><code class="lang-text">Page::RemoveHeader(<span class="hljs-string">"page-name"</span>);
</code></pre>
    <h3 id="remove-footer-in-specific-page">Remove Footer in Specific page</h3>
    <pre><code class="lang-text">Page::RemoveHeader(<span class="hljs-string">"page-name"</span>);
</code></pre>
    <h3 id="switch-to-html">Switch to html</h3>
    <pre><code class="lang-text">Router::$Extension = <span class="hljs-string">".html"</span>;
</code></pre>
    <h3 id="disable-auto-router">Disable Auto Router</h3>
    <pre><code class="lang-text">Page::$AutoRouter = <span class="hljs-literal">false</span>;
</code></pre>
    <h3 id="project-name-remove-if-deploy-to-server-">Project name (remove if deploy to server )</h3>
    <pre><code class="lang-text">Router::SetRoot(<span class="hljs-string">"project-name"</span>);
</code></pre>
    <h2 id="-index-php">📄 index.php</h2>
    <p><code>index.php</code> is the root page of the project. You can modify elements in here. However, leave the <code>Page::Index();</code> in <code>&lt;Body&gt;</code> tag for the routing to work.</p>
    <h3 id="add-bootstrap">Add Bootstrap</h3>
    <pre><code class="lang-text">Page::LoadBootstrap();
</code></pre>
    <h3 id="add-tailwind">Add Tailwind</h3>
    <pre><code class="lang-text">Page::LoadTainwind();
</code></pre>
    <h2 id="-manualrouter-php">📄 ManualRouter.php</h2>
    <p><code>ManualRouter.php</code> is used for manual routing or routing in sub folder. This file can be deleted if you are using Auto Router.
        Use <code>&quot;Request URl&quot; =&gt; &quot;File Path&quot;</code> array structure for manual routing.</p>
    <h2 id="default-values">Default Values</h2>
    <table>
        <thead>
            <tr>
                <th style="text-align:left">Code</th>
                <th style="text-align:left">Action</th>
                <th style="text-align:left">Default</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:left"><code>Router::SetRoot(&quot;project-name&quot;);</code></td>
                <td style="text-align:left">Project name (remove if deploy to server )</td>
                <td style="text-align:left">/</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Router::$Home_Page = &quot;home&quot;;</code></td>
                <td style="text-align:left">Change Home page</td>
                <td style="text-align:left">True</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Layout::$Header = false;</code></td>
                <td style="text-align:left">Remove header on all pages</td>
                <td style="text-align:left">True</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Layout::$Footer = false;</code></td>
                <td style="text-align:left">Remove footer on all pages</td>
                <td style="text-align:left">True</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Page::RemoveHeader(&quot;page-name&quot;);</code></td>
                <td style="text-align:left">Remove Header in Specific page</td>
                <td style="text-align:left">None</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Page::RemoveFooter(&quot;page-name&quot;);</code></td>
                <td style="text-align:left">Remove Footer in Specific page</td>
                <td style="text-align:left">None</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Router::$Extension = &quot;.html&quot;;</code></td>
                <td style="text-align:left">Switch to html mode</td>
                <td style="text-align:left">.php</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Page::$AutoRouter = false;</code></td>
                <td style="text-align:left">Disable Auto Router</td>
                <td style="text-align:left">True</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Page::LoadBootstrap();</code></td>
                <td style="text-align:left">Add Bootstrap</td>
                <td style="text-align:left">True</td>
            </tr>
            <tr>
                <td style="text-align:left"><code>Page::LoadTailwind();</code></td>
                <td style="text-align:left">Add Tailwind</td>
                <td style="text-align:left">True</td>
            </tr>
        </tbody>
    </table>
</section>