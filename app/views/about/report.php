<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/about/report.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>UnWe - Unemployment Web Visualizer</title>
</head>

<body>
    <article>
        <header>
            <h1> UnWe - Unemployment Web Visualizer </h1>
            <div role="contentinfo">
                <section typeof="sa:AuthorsList">
                    <h2> Authors </h2>
                    <ul>
                        <li typeof="sa:ContributorRole" property="schema:author">
                            <span typeof="schema:Person" resource="https://www.linkedin.com/in/adana-popescu/">
                                <meta property="schema:givenName" content="Adana">
                                <meta property="schema:familyName" content="Popescu">
                                <span property="schema:name"> Adana Popescu </span>
                            </span>
                        </li>
                        <li typeof="sa:ContributorRole" property="schema:author">
                            <span typeof="schema:Person" resource="https://github.com/adrian-vatui">
                                <meta property="schema:givenName" content="Adrian">
                                <meta property="schema:additionalName" content="Mihai">
                                <meta property="schema:familyName" content="Vătui">
                                <span property="schema:name"> Adrian-Mihai Vătui </span>
                            </span>
                        </li>
                        <li typeof="sa:ContributorRole" property="schema:author">
                            <span typeof="schema:Person" resource="https://github.com/craciunmarian">
                                <meta property="schema:givenName" content="Răzvan">
                                <meta property="schema:additionalName" content="Marian">
                                <meta property="schema:familyName" content="Crăciun">
                                <span property="schema:name"> Răzvan-Marian Crăciun </span>
                            </span>
                        </li>
                    </ul>
                </section>
            </div>
        </header>

        <section typeof="sa:Introduction" role="doc-introduction">
            <h2> Introduction </h2>

            <section>
                <h3> Approach </h3>
                We started our project by analizing the requirements and making a list of the items that had to be implemented in order to simulate a real website. We then had an <a href="https://www.adobe.com/products/xd.html">Adobe XD</a> file created by one of our team members in order to have clear guidelines about the visual aspect of our project. We then proceeded to split our work as evenly as possible, each of us being responsible with writing the HTML and CSS for one page. We used a similar approach for designing and implementing the backend and the API, by first drawing the Use Case diagrams and writing down our tasks and responsibilities (using <a href="https://trello.com/">Trello</a>). We have also used <a href="https://github.com/">GitHub</a> for version control.

                <figure>
                    <img class="usecase" src="/assets/about/useCase1.svg" alt="Use Case Diagram #1">
                    <figcaption> Web Application Use Case Diagram </figcaption>
                </figure>

                <figure>
                    <img class="usecase" src="/assets/about/useCase2.svg" alt="Use Case Diagram #2">
                    <figcaption> API Use Case Diagram </figcaption>
                </figure>
            </section>



            <section>
                <h3> Purpose </h3>
                <p>
                    The purpose of this project is to create an interactive platform to visualize statistics and data about unemployment in Romania. It is primarily used to showcase either the increase or decrease in unemployment.
                </p>
            </section>

            <section>
                <h3> Product Scope </h3>
                <p>
                    The website will mainly be used in an informative scope. It uses official data taken from the government to showcase the unemployment rates, displaying it in different manners such as pie charts, column charts etc. Users will also be able to either view data from each city or directly compare cities using different filters and time frames. The API can be used by anyone without restrictions to query available data in JSON format.
                </p>
            </section>

            <section>
                <h3>Web Application Usage Guide</h3>
                <p>
                    You can navigate through the different pages using the links in the header of each page. To generate a chart, you have to fill in the desired filters in the form found on the <a href="/visualizer">Stastistics</a> and click the "Generate" button. The generated charts will be automatically viewed and you can choose to download them by clicking the "Download" button.
                </p>
            </section>

            <section>
                <h2> References </h2>
                <p>
                    All the data this website uses will be extracted from he Romanian government's official <a href="https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc">website</a>, using a webcrawler. We used the <a href="https://www.mysql.com/">MySQL</a> database provided by <a href="https://www.phpmyadmin.net/">phpMyAdmin</a> to store and query the extracted data. We displayed the data in the form of maps and charts using the <a href=" https://openlayers.org/">Openlayers</a> and <a href="https://www.chartjs.org/">Chartjs</a> libraries. We used an open-source <a href="https://github.com/MrRio/jsPDF">library</a> for converting the charts to PDF format. </p>
            </section>
        </section>

        <section>
            <h2> Overall Description </h2>

            <section>
                <h3> App Architecture </h3>

                <p>
                    The app uses the classic MVC architecture to display the requested pages. It communicates with a MySQL database which has 2 tables: one with data regarding unemplyment, and one with valid API tokens. Whenever a chart is generated, the app sends a request to the API which queries the database and returns a JSON object with the desired answer. The returned data is then displayed. Whenever a refresh request is sent to the API, the app uses a webcrawler to scrape the government website and obtain the required data, which it then inserts into the database.
                </p>

                <figure>
                    <img src="/assets/about/architecture.svg" id="architecture" alt="App architecture">
                    <figcaption> App architecture diagram </figcaption>
                </figure>
            </section>

            <section>
                <h3> Product Functions </h3>

                <ul>
                    <li> visualize data in different manners including charts and cartographic representation</li>
                    <li> compare counties using filters such as education level, age, gender etc.</li>
                    <li> visualize data using adjustable time frames</li>
                    <li> export data in different formats such as csv, svg, pdf etc.</li>
                    <li> provide a public API that can be used to query official data about unemployment </li>
                </ul>
            </section>

            <section>
                <h3> User Classes and Characteristics </h3>

                <p>
                    The types of users that are anticipated to use this product the most are the following: statistics enthusiasts that have a good understanding of the represented data, users that would like to access the provided export option in order to process or visualize it afterwards, and curious users that would prefer a visual representation over the government provided text statistics. The first two aforementioned user classes are the most important to satisfy in order to achieve the goal of this project. We also designed the API taking into consideration other developers looking to use this data and made it as accessible as possible.
                </p>
            </section>
        </section>

        <section>
            <h2> System Features </h2>

            <section>
                <h3>Automatic data collection</h3>

                <p>
                    Users with API keys provided by us can use the API to check the official source for new data and automatically import it in the database so that it can be immediately used for other functions.
                </p>
            </section>

            <section>
                <h3> Responsive and intuitive interface </h3>

                <p>
                    The website will work on most current-day browsers for any device and it will automatically resize in order to maintain readability on smaller screens. The interaction between the user and the product is very fluid and intuitive, the user being only required to fill out a form with his selections regarding the data and the manner in which it will be visualized.
                </p>
            </section>

            <section>
                <h3>Data representation</h3>

                <p>
                    The main feature of the website is giving the user different filter options to sort the data and display it using multiple chart options including a cartographic representation of Romania.
                </p>
            </section>
        </section>
    </article>
</body>

</html>