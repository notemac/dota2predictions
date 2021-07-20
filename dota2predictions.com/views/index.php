<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/all-index.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./js/themes/redstyle-tooltip.css">
    <title>Dota 2 Predictions</title>
    <link rel="icon" type="image/png" href="./favicon.png">
</head>

<body>
    <header>
        <div class="header-body">
            <!-- <img class="header-logo" src="./assets/dota2logo3.png" alt=""> -->
            <div class="logo-wrapper active-menu-item">
                <img class="d2pl-top" src="./assets/d7logo.png" alt="">
                <div class="lw-item1 yellow">Dota 2 <span class="beta">beta version</span></div>
                <div class="lw-item2 yellow">Predictions</div>
                <div class="mi-highlighter"></div>
            </div>
            <div class="menu">
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./faq.php">FAQ</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./subscribe.php">SUBSCRIBE</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper'>
                    <a class="mi-title" href="./contact.php">CONTACT US</a>
                    <div class="mi-highlighter"></div>
                </div>
                <div class='menu-item-wrapper'>
                    <div class="user-account">
                        <div>
                            <?= $_SESSION['user_name'] ?>
                        </div>
                        <div>
                            &#8227;
                        </div>
                    </div>
                    <div class="mi-highlighter"></div>
                    <div class="dropdown-wrapper">
                        <ul class="dropdown-menu">
                            <li><a href="./index.php?logout">Logout</a></li>
                            <li><a>View profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="match-info">
            <div class="teams-info">
                <div id="radiant" class="teams-info-item">Radiant Team</div>
                <div class="teams-info-item">VS</div>
                <div id="dire" class="teams-info-item">Dire Team</div>
            </div>
            <div class="teams-icons-wrapper">
                <div class="teams-icons">
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Alliance" alt="111474" src="./assets/teams/alliance.png">
                        </div>
                        <div> Alliance </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Evil Geniuses" alt="39" src="./assets/teams/eg.png">
                        </div>
                        <div>
                            Evil Geniuses
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="EHOME" alt="4" src="./assets/teams/ehome.png">
                        </div>
                        <div>
                            EHOME
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Fnatic" alt="350190" src="./assets/teams/fnatic.png">
                        </div>
                        <div>
                            Fnatic
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Natus Vincere" alt="36" src="./assets/teams/navi.png">
                        </div>
                        <div>
                            Natus Vincere
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="OG" alt="2586976" src="./assets/teams/og.png">
                        </div>
                        <div>
                            OG
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="PSG.LGD" alt="15" src="./assets/teams/psg-lgd.png">
                        </div>
                        <div>
                            PSG.LGD
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Team Empire" alt="46" src="./assets/teams/empire.png">
                        </div>
                        <div>
                            Team Empire
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Team Liquid" alt="2163" src="./assets/teams/tl.png">
                        </div>
                        <div>
                            Team Liquid
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Team Secret" alt="1838315" src="./assets/teams/ts.png">
                        </div>
                        <div>
                            Team Secret
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Vici Gaming" alt="726228" src="./assets/teams/vici.png">
                        </div>
                        <div>
                            Vici Gaming
                        </div>
                    </div>
                    <div class="teams-icons-item">
                        <div>
                            <img class="checkableTeam" name="Virtus.pro" alt="1883502" src="./assets/teams/virtus-pro.png">
                        </div>
                        <div>
                            Virtus.pro
                        </div>
                    </div>
                </div>
            </div>
            <div id="heroes-info" class="heroes-info">
                <div class="heroes-outer-info-item">
                    <div id="radiant-heroes" class="heroes-info-item">
                        <div id="h1" class="hero-slot">
                        </div>
                        <div id="h2" class="hero-slot" style="margin-right: 3px; margin-left: 3px;">
                        </div>
                        <div id="h3" class="hero-slot">
                        </div>
                        <div id="h4" class="hero-slot" style="margin-right: 3px; margin-left: 3px;">
                        </div>
                        <div id="h5" class="hero-slot">
                        </div>
                    </div>
                </div>
                <div class="heroes-outer-info-item">
                    <div id="dire-heroes" class="heroes-info-item">
                        <div id="h6" class="hero-slot">
                        </div>
                        <div id="h7" class="hero-slot" style="margin-right: 3px; margin-left: 3px;">
                        </div>
                        <div id="h8" class="hero-slot">
                        </div>
                        <div id="h9" class="hero-slot" style="margin-right: 3px; margin-left: 3px;">
                        </div>
                        <div id="h10" class="hero-slot">
                        </div>
                    </div>
                </div>
            </div>
            <div class="heroes-icons-wrapper">
                <div class="heroes-icons">
                    <img class="checkableHero" name="abaddon" src="./assets/heroes/abaddon.png">
                    <img class="checkableHero" name="alchemist" src="./assets/heroes/alchemist.png">
                    <img class="checkableHero" name="ancient-apparition" src="./assets/heroes/ancient-apparition.png">
                    <img class="checkableHero" name="anti-mage" src="./assets/heroes/anti-mage.png">
                    <img class="checkableHero" name="arc-warden" src="./assets/heroes/arc-warden.png">
                    <img class="checkableHero" name="axe" src="./assets/heroes/axe.png">
                    <img class="checkableHero" name="bane" src="./assets/heroes/bane.png">
                    <img class="checkableHero" name="batrider" src="./assets/heroes/batrider.png">
                    <img class="checkableHero" name="beastmaster" src="./assets/heroes/beastmaster.png">
                    <img class="checkableHero" name="bloodseeker" src="./assets/heroes/bloodseeker.png">
                    <img class="checkableHero" name="bounty-hunter" src="./assets/heroes/bounty-hunter.png">
                    <img class="checkableHero" name="brewmaster" src="./assets/heroes/brewmaster.png">
                    <img class="checkableHero" name="bristleback" src="./assets/heroes/bristleback.png">
                    <img class="checkableHero" name="broodmother" src="./assets/heroes/broodmother.png">
                    <img class="checkableHero" name="centaur-warrunner" src="./assets/heroes/centaur-warrunner.png">
                    <img class="checkableHero" name="chaos-knight" src="./assets/heroes/chaos-knight.png">
                    <img class="checkableHero" name="chen" src="./assets/heroes/chen.png">
                    <img class="checkableHero" name="clinkz" src="./assets/heroes/clinkz.png">
                    <img class="checkableHero" name="clockwerk" src="./assets/heroes/clockwerk.png">
                    <img class="checkableHero" name="crystal-maiden" src="./assets/heroes/crystal-maiden.png">
                    <img class="checkableHero" name="dark-seer" src="./assets/heroes/dark-seer.png">
                    <img class="checkableHero" name="dark-willow" src="./assets/heroes/dark-willow.png">
                    <img class="checkableHero" name="dazzle" src="./assets/heroes/dazzle.png">
                    <img class="checkableHero" name="death-prophet" src="./assets/heroes/death-prophet.png">
                    <img class="checkableHero" name="disruptor" src="./assets/heroes/disruptor.png">
                    <img class="checkableHero" name="doom" src="./assets/heroes/doom.png">
                    <img class="checkableHero" name="dragon-knight" src="./assets/heroes/dragon-knight.png">
                    <img class="checkableHero" name="drow-ranger" src="./assets/heroes/drow-ranger.png">
                    <img class="checkableHero" name="earth-spirit" src="./assets/heroes/earth-spirit.png">
                    <img class="checkableHero" name="earthshaker" src="./assets/heroes/earthshaker.png">
                    <img class="checkableHero" name="elder-titan" src="./assets/heroes/elder-titan.png">
                    <img class="checkableHero" name="ember-spirit" src="./assets/heroes/ember-spirit.png">
                    <img class="checkableHero" name="enchantress" src="./assets/heroes/enchantress.png">
                    <img class="checkableHero" name="enigma" src="./assets/heroes/enigma.png">
                    <img class="checkableHero" name="faceless-void" src="./assets/heroes/faceless-void.png">
                    <img class="checkableHero" name="grimstroke" src="./assets/heroes/grimstroke.png">
                    <img class="checkableHero" name="gyrocopter" src="./assets/heroes/gyrocopter.png">
                    <img class="checkableHero" name="huskar" src="./assets/heroes/huskar.png">
                    <img class="checkableHero" name="invoker" src="./assets/heroes/invoker.png">
                    <img class="checkableHero" name="io" src="./assets/heroes/io.png">
                    <img class="checkableHero" name="jakiro" src="./assets/heroes/jakiro.png">
                    <img class="checkableHero" name="juggernaut" src="./assets/heroes/juggernaut.png">
                    <img class="checkableHero" name="keeper-of-the-light" src="./assets/heroes/keeper-of-the-light.png">
                    <img class="checkableHero" name="kunkka" src="./assets/heroes/kunkka.png">
                    <img class="checkableHero" name="legion-commander" src="./assets/heroes/legion-commander.png">
                    <img class="checkableHero" name="leshrac" src="./assets/heroes/leshrac.png">
                    <img class="checkableHero" name="lich" src="./assets/heroes/lich.png">
                    <img class="checkableHero" name="lifestealer" src="./assets/heroes/lifestealer.png">
                    <img class="checkableHero" name="lina" src="./assets/heroes/lina.png">
                    <img class="checkableHero" name="lion" src="./assets/heroes/lion.png">
                    <img class="checkableHero" name="lone-druid" src="./assets/heroes/lone-druid.png">
                    <img class="checkableHero" name="luna" src="./assets/heroes/luna.png">
                    <img class="checkableHero" name="lycan" src="./assets/heroes/lycan.png">
                    <img class="checkableHero" name="magnus" src="./assets/heroes/magnus.png">
                    <img class="checkableHero" name="medusa" src="./assets/heroes/medusa.png">
                    <img class="checkableHero" name="meepo" src="./assets/heroes/meepo.png">
                    <img class="checkableHero" name="mirana" src="./assets/heroes/mirana.png">
                    <img class="checkableHero" name="monkey-king" src="./assets/heroes/monkey-king.png">
                    <img class="checkableHero" name="morphling" src="./assets/heroes/morphling.png">
                    <img class="checkableHero" name="naga-siren" src="./assets/heroes/naga-siren.png">
                    <img class="checkableHero" name="natures-prophet" src="./assets/heroes/natures-prophet.png">
                    <img class="checkableHero" name="necrophos" src="./assets/heroes/necrophos.png">
                    <img class="checkableHero" name="night-stalker" src="./assets/heroes/night-stalker.png">
                    <img class="checkableHero" name="nyx-assassin" src="./assets/heroes/nyx-assassin.png">
                    <img class="checkableHero" name="ogre-magi" src="./assets/heroes/ogre-magi.png">
                    <img class="checkableHero" name="omniknight" src="./assets/heroes/omniknight.png">
                    <img class="checkableHero" name="oracle" src="./assets/heroes/oracle.png">
                    <img class="checkableHero" name="outworld-devourer" src="./assets/heroes/outworld-devourer.png">
                    <img class="checkableHero" name="pangolier" src="./assets/heroes/pangolier.png">
                    <img class="checkableHero" name="phantom-assassin" src="./assets/heroes/phantom-assassin.png">
                    <img class="checkableHero" name="phantom-lancer" src="./assets/heroes/phantom-lancer.png">
                    <img class="checkableHero" name="phoenix" src="./assets/heroes/phoenix.png">
                    <img class="checkableHero" name="puck" src="./assets/heroes/puck.png">
                    <img class="checkableHero" name="pudge" src="./assets/heroes/pudge.png">
                    <img class="checkableHero" name="pugna" src="./assets/heroes/pugna.png">
                    <img class="checkableHero" name="queen-of-pain" src="./assets/heroes/queen-of-pain.png">
                    <img class="checkableHero" name="razor" src="./assets/heroes/razor.png">
                    <img class="checkableHero" name="riki" src="./assets/heroes/riki.png">
                    <img class="checkableHero" name="rubick" src="./assets/heroes/rubick.png">
                    <img class="checkableHero" name="sand-king" src="./assets/heroes/sand-king.png">
                    <img class="checkableHero" name="shadow-demon" src="./assets/heroes/shadow-demon.png">
                    <img class="checkableHero" name="shadow-fiend" src="./assets/heroes/shadow-fiend.png">
                    <img class="checkableHero" name="shadow-shaman" src="./assets/heroes/shadow-shaman.png">
                    <img class="checkableHero" name="silencer" src="./assets/heroes/silencer.png">
                    <img class="checkableHero" name="skywrath-mage" src="./assets/heroes/skywrath-mage.png">
                    <img class="checkableHero" name="slardar" src="./assets/heroes/slardar.png">
                    <img class="checkableHero" name="slark" src="./assets/heroes/slark.png">
                    <img class="checkableHero" name="sniper" src="./assets/heroes/sniper.png">
                    <img class="checkableHero" name="spectre" src="./assets/heroes/spectre.png">
                    <img class="checkableHero" name="spirit-breaker" src="./assets/heroes/spirit-breaker.png">
                    <img class="checkableHero" name="storm-spirit" src="./assets/heroes/storm-spirit.png">
                    <img class="checkableHero" name="sven" src="./assets/heroes/sven.png">
                    <img class="checkableHero" name="techies" src="./assets/heroes/techies.png">
                    <img class="checkableHero" name="templar-assassin" src="./assets/heroes/templar-assassin.png">
                    <img class="checkableHero" name="terrorblade" src="./assets/heroes/terrorblade.png">
                    <img class="checkableHero" name="tidehunter" src="./assets/heroes/tidehunter.png">
                    <img class="checkableHero" name="timbersaw" src="./assets/heroes/timbersaw.png">
                    <img class="checkableHero" name="tinker" src="./assets/heroes/tinker.png">
                    <img class="checkableHero" name="tiny" src="./assets/heroes/tiny.png">
                    <img class="checkableHero" name="treant-protector" src="./assets/heroes/treant-protector.png">
                    <img class="checkableHero" name="troll-warlord" src="./assets/heroes/troll-warlord.png">
                    <img class="checkableHero" name="tusk" src="./assets/heroes/tusk.png">
                    <img class="checkableHero" name="underlord" src="./assets/heroes/underlord.png">
                    <img class="checkableHero" name="undying" src="./assets/heroes/undying.png">
                    <img class="checkableHero" name="ursa" src="./assets/heroes/ursa.png">
                    <img class="checkableHero" name="vengeful-spirit" src="./assets/heroes/vengeful-spirit.png">
                    <img class="checkableHero" name="venomancer" src="./assets/heroes/venomancer.png">
                    <img class="checkableHero" name="viper" src="./assets/heroes/viper.png">
                    <img class="checkableHero" name="visage" src="./assets/heroes/visage.png">
                    <img class="checkableHero" name="warlock" src="./assets/heroes/warlock.png">
                    <img class="checkableHero" name="weaver" src="./assets/heroes/weaver.png">
                    <img class="checkableHero" name="windranger" src="./assets/heroes/windranger.png">
                    <img class="checkableHero" name="winter-wyvern" src="./assets/heroes/winter-wyvern.png">
                    <img class="checkableHero" name="witch-doctor" src="./assets/heroes/witch-doctor.png">
                    <img class="checkableHero" name="wraith-king" src="./assets/heroes/wraith-king.png">
                    <img class="checkableHero" name="zeus" src="./assets/heroes/zeus.png">
                </div>
            </div>
        </div>
        <div class="predict-button-wrapper">
            <div class="predict-button">PREDICT</div>
        </div>
        <div class="prediction-wrapper">
        </div>
        <!-- <div class="more-wrapper">
            <div class="more-body">
                <div class="more-row">
                    <div class="more-item ">Factor</div>
                    <div class="more-item ">Value</div>
                    <div class="more-item odds-wrapper">
                        <div class="odds-wrapper-header">Odds of winning</div>
                        <div class="odds-wrapper-body">
                            <div class="more-item ">Team Secret</div>
                            <div class="more-item ">Fnatic</div>
                        </div>
                    </div>
                </div>
                <div class="more-row">
                    <div class="more-item ">HD</div>
                    <div class="more-item ">-8.1267</div>
                    <div class="more-item ">1.123</div>
                    <div class="more-item ">1.123</div>
                </div>
                <div class="more-row">
                    <div class="more-item">HWR</div>
                    <div class="more-item ">0.12</div>
                    <div class="more-item ">0.123</div>
                    <div class="more-item ">1.123</div>
                </div>
                <div class="more-row">
                    <div class="more-item">HWR</div>
                    <div class="more-item ">0.12</div>
                    <div class="more-item ">0.123</div>
                    <div class="more-item ">1.123</div>
                </div>
                <div class="more-row">
                    <div class="more-item">HWR</div>
                    <div class="more-item ">0.12</div>
                    <div class="more-item ">0.123</div>
                    <div class="more-item ">1.123</div>
                </div>
                <div class="more-row">
                    <div class="more-item">ALMD</div>
                    <div class="more-item ">0.12</div>
                    <div class="more-item ">0.123</div>
                    <div class="more-item ">1.123</div>
                </div>
                <div class="more-row">
                    <div class="more-item">VW</div>
                    <div class="more-item ">0.12</div>
                    <div class="more-item ">0.123</div>
                    <div class="more-item ">1.123</div>
                </div>
            </div>
        </div> -->
        <div class="go-up">
            <div class="gu-arrow">&#10150;</div>
            <span class="gu-text">Go up</span>
        </div>
    </main>
    <footer>
        <div class="footer-body">
            &copy; Dota2Predictions&trade;, 2019.
        </div>
    </footer>
    <script>
        // function getScrollbarWidth() {
        //     var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div>');
        //     $('body').append(div);
        //     var w1 = $('div', div).innerWidth();
        //     div.css('overflow-y', 'scroll');
        //     var w2 = $('div', div).innerWidth();
        //     $(div).remove();
        //     return (w1 - w2);
        // }
        // alert(getScrollbarWidth());
        // ZOOOOOOOOOOOM 90%
        document.body.style.zoom = "90%";
    </script>
    <script src="./js/jquery-3.4.0.min.js"></script>
    <script src="./js/jquery.imgcheckbox.js"></script>
    <!--TOOLTIPS  https://atomiks.github.io/tippyjs/ -->
    <script src="./js/popper.min.js"></script>
    <script src="./js/index.all.min.js"></script>
    <!--TOOLTIPS -->
    <script src="./js/d2predicts3.js"></script>
</body>

</html>