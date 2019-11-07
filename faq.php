<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Frequently asked questions - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#selfhelp"><i class="fa fa-angle-double-left"></i> Lifestyle treatments</a></h2>
            <h1 class="text-h1" style="padding: 0;">Frequently asked questions</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h2">Anxiety</h2>
                
                <h3 class="text-h3">What is anxiety?</h3>
                <p>The American Psychological Association (APA) defines anxiety as "an emotion characterized by feelings of tension, worried thoughts and physical changes like increased blood pressure."</p>
                <p>Knowing the difference between normal feelings of anxiety and an anxiety disorder requiring medical attention can help a person identify and treat the condition.</p>
                <p>In this article, we look at the differences between anxiety and anxiety disorder, the different types of anxiety, and the available treatment options.</p>

                <h3 class="text-h3">What causes anxiety?</h3>
                <p>The causes of anxiety disorders are complicated. Many might occur at once, some may lead to others, and some might not lead to an anxiety disorder unless another is present.</p>
                <p>Possible causes include:</p>
                <ul class="bulleted-list">
                    <li>environmental stressors, such as difficulties at work, relationship problems, or family issues</li>
                    <li>genetics, as people who have family members with an anxiety disorder are more likely to experience one themselve</li>
                    <li>medical factors, such as the symptoms of a different disease, the effects of a medication, or the stress of an intensive surgery or prolonged recovery</li>
                    <li>brain chemistry, as psychologists define many anxiety disorders as misalignments of hormones and electrical signals in the brain</li>
                    <li>withdrawal from an illicit substance, the effects of which might intensify the impact of other possible causes</li>
                </ul>

                <h3 class="text-h3">What are the symptoms of anxiety?</h3>
                <p>While a number of different diagnoses constitute anxiety disorders, the symptoms of generalized anxiety disorder (GAD) will often include the following:</p>
                <ul class="bulleted-list">
                    <li>restlessness, and a feeling of being "on-edge"</li>
                    <li>uncontrollable feelings of worry</li>
                    <li>increased irritability</li>
                    <li>concentration difficulties</li>
                    <li>sleep difficulties, such as problems in falling or staying asleep</li>
                </ul>
                <p>While these symptoms might be normal to experience in daily life, people with GAD will experience them to persistent or extreme levels. GAD may present as vague, unsettling worry or a more severe anxiety that disrupts day-to-day living.</p>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Depression</h2>

                <h3 class="text-h3">What is depression?</h3>
                <p>Depression (or Major Depressive Disorder) is a common and serious medical illness that negatively affects how you feel, think, and act. It is more than just feeling sad, depression affects a person’s ability to navigate daily activities, relationships, school and work, and often decreases their quality of life.</p>
                <p>If you’re depressed, you may feel like you’ve lost all hope and worth, and that nobody understands what you’re going through. You may even feel ashamed of yourself - but you don’t have to! Depression can happen to anyone and it is not something that you should be ashamed of. You’re not alone and there is hope, there are plenty of things you can do to help yourself start to regain your balance and feel more positive, energetic, and hopeful again.</p>

                <h3 class="text-h3">What are the signs and symptoms of depression?</h3>
                <ul class="bulleted-list">
                    <li>
                        Emotional Signs
                        <ul class="bulleted-list">
                            <li>Angry outbursts, irritability, or restlessness</li>
                            <li>Avoiding friends and activities they once enjoyed</li>
                            <li>Feeling sad, empty, numb, hopeless, helpless, or worthless</li>
                        </ul>
                    </li>

                    <li>
                        Physical Signs
                        <ul class="bulleted-list">
                            <li>Changes in energy level (tiredness)</li>
                            <li>Changes in eating (overeating or eating too little)</li>
                            <li>Changes in sleep patterns (sleeping too much or too little)</li>
                            <li>Problems with concentration, memory, or ability to think clearly</li>
                            <li>Being unable to complete tasks</li>
                            <li>Sudden decrease in school or work performance</li>
                        </ul>
                    </li>

                    <li>
                        Serious Signs
                        <ul class="bulleted-list">
                            <li>Thoughts or plans to kill or hurt oneself or others</li>
                            <li>Running away from home</li>
                        </ul>
                    </li>
                </ul>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Stress</h2>

                <h3 class="text-h3">What is stress?</h3>
                <p>Stress is a feeling of being under abnormal pressure. This pressure can come from different aspects of your day to day life. Such as an increased workload, a transitional period, an argument you have with your family or new and existing financial worries. You may find that it has a cumulative effect, with each stressor building on top of one another.</p>
                <p>During these situations you may feel threatened or upset and your body might create a stress response. This can cause a variety of physical symptoms, change the way you behave, and lead you to experience more intense emotions.</p>
                <p>Stress affects us in a number of ways, both physically and emotionally and in varying intensities,</p>

                <h3 class="text-h3">What causes stress?</h3>
                <p>All sorts of situations can cause stress. The most common involve work, money matters and relationships with partners, children or other family members</p>
                <p>Stress may be caused either by major upheavals and life events such as divorce, unemployment, moving house and bereavement, or by a series of minor irritations such as feeling undervalued at work or arguing with a family member. Sometimes, there are no obvious causes.</p>

                <h3 class="text-h3">How can I identify the signs of stress?</h3>
                <p>Everyone experiences stress. However, when it is affecting your life, health and wellbeing, it is important to tackle it as soon as possible, and while stress affects everyone differently, there are common signs and symptoms you can look out for:</p>
                <ul class="bulleted-list">
                    <li>feelings of constant worry or anxiety</li>
                    <li>feelings of being overwhelmed</li>
                    <li>difficulty concentrating</li>
                    <li>mood swings or changes in your mood</li>
                    <li>irritability or having a short temper</li>
                    <li>difficulty relaxing</li>
                    <li>depression</li>
                    <li>low self-esteem</li>
                    <li>eating more or less than usual</li>
                    <li>changes in your sleeping habits</li>
                    <li>using alcohol, tobacco or illegal drugs to relax</li>
                    <li>aches and pains, particularly muscle tension</li>
                    <li>diarrhoea and constipation</li>
                    <li>feelings of nausea or dizziness</li>
                    <li>loss of sex drive.</li>
                </ul>

                <h3 class="text-h3">What can prolonged stress lead to?</h3>
                <p>Stress is a natural reaction to many situations in life, such as work, family, relationships and money problems.</p>
                <p>We mentioned earlier on that a moderate amount of stress can help us perform better in challenging situations, but too much or prolonged stress can lead to physical problems. This can include lower immunity levels,digestive and intestinal difficulties, e.g. irritable bowel syndrome (IBS), or mental health problems such as depression.This means it is important to manage your stress and keep it at a healthy level to prevent long-term damage to your body and mind.</p>
            </section>
        </main>
    </body>
</html>