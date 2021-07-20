// https://jquery.com/
// https://github.com/jcuenod/imgCheckbox/

// ВЫБОР КОМАНД
var radiantTeam = undefined;
var direTeam = undefined;
var isRadiant = undefined; // выбирается команда сил света?
var elemTeamsIcons = document.getElementsByClassName('teams-icons')[0];

$('#radiant, #dire').click(function(event) {
    if ($(this)[0].id == 'radiant') {
        if (direTeam != undefined) direTeam.deselect();
        if (radiantTeam != undefined) radiantTeam.select();
        if (isRadiant == undefined) { // показываем список команд
            isRadiant = true;
            elemTeamsIcons.style.display='flex';
        }
        else if (isRadiant) { // скрываем список команд
            isRadiant = undefined;
            elemTeamsIcons.style.display='none';
        }
        else {
            isRadiant = true;
        }
    } 
    else { // dire
        if (radiantTeam != undefined) radiantTeam.deselect();
        if (direTeam != undefined) direTeam.select();
        if (isRadiant == undefined) { // показываем список команд
            isRadiant = false;
            elemTeamsIcons.style.display='flex';
        }
        else if (!isRadiant) { // скрываем список команд
            isRadiant = undefined;
            elemTeamsIcons.style.display='none';
        }
        else {
            isRadiant = false;
        }
    }
});

$("img.checkableTeam").imgCheckbox({ "graySelected": false, "scaleSelected": false,
onclick: function(selectedItem) {
    if (isRadiant) {
        if ((direTeam != undefined) && (direTeam.children()[0].name == selectedItem.children()[0].name)) {
            document.getElementById('dire').innerHTML = 'Dire Team';
            direTeam = undefined;
        }
        // если еще ни одна команда не выбрана
        if (radiantTeam == undefined) {
            radiantTeam = selectedItem;
            var name = radiantTeam.children()[0].name;
            document.getElementById('radiant').innerHTML = `<img name="${name}" src="./assets/teams/${name}.png"><div style=font-size: 11px; margin-top: 50px;">PSG.LGD</div>`;
            // $('.teams-info-item').css('justify-content', 'center');
            // скрываем список команд
            isRadiant = undefined;
            elemTeamsIcons.style.display='none';
        } // если отменили текущий выбор
        else if (radiantTeam.children()[0].name == selectedItem.children()[0].name) {
            radiantTeam = undefined;
            document.getElementById('radiant').innerHTML = 'Radiant Team';
        } // выбрали другую команду
        else {
            radiantTeam.deselect();
            radiantTeam = selectedItem;
            var name = radiantTeam.children()[0].name;
            document.getElementById('radiant').innerHTML = `<img name="${name}" src="./assets/teams/${name}.png">`;
            // скрываем список команд
            isRadiant = undefined;
            elemTeamsIcons.style.display='none';
        }
    } // dire
    else {
        if ((radiantTeam != undefined) && (radiantTeam.children()[0].name == selectedItem.children()[0].name)) {
            document.getElementById('radiant').innerHTML = 'Radiant Team';
            radiantTeam = undefined;
        }
        // если еще ни одна команда не выбрана
        if (direTeam == undefined) {
            direTeam = selectedItem;
            var name = direTeam.children()[0].name;
            document.getElementById('dire').innerHTML = `<img name="${name}" src="./assets/teams/${name}.png">`;
            // скрываем список команд
            isRadiant = undefined;
            elemTeamsIcons.style.display='none';
        } // если отменили текущий выбор
        else if (direTeam.children()[0].name == selectedItem.children()[0].name) {
            direTeam = undefined;
            document.getElementById('dire').innerHTML = 'Dire Team';
        } // выбрали другую команду
        else {
            direTeam.deselect();
            direTeam = selectedItem;
            var name = direTeam.children()[0].name;
            document.getElementById('dire').innerHTML = `<img name="${name}" src="./assets/teams/${name}.png">`;
            // скрываем список команд
            isRadiant = undefined;
            elemTeamsIcons.style.display='none';
        }
    }
} });


// ВЫБОР ГЕРОЕВ
var radiantHeroes = [];
var direHeroes = [];
var isRadiant = undefined; // выбираются герои сил света?
var elemHeroesIcons = document.getElementsByClassName('heroes-icons')[0];

$('#radiant-heroes, #dire-heroes').click(function(event) {
    if ($(this)[0].id == 'radiant-heroes') {
        direHeroes.forEach(hero => {if (hero != undefined) hero.deselect()});
        radiantHeroes.forEach(hero => {if (hero != undefined) hero.select()});
        if (isRadiant == undefined) { // показываем список гереов
            isRadiant = true;
            elemHeroesIcons.style.display='flex';
        }
        else if (isRadiant) { // скрываем список героев
            isRadiant = undefined;
            elemHeroesIcons.style.display='none';
        }
        else isRadiant = true;
    } 
    else { // dire-heroes
        radiantHeroes.forEach(hero => {if (hero != undefined) hero.deselect()});
        direHeroes.forEach(hero => {if (hero != undefined) hero.select()});
        if (isRadiant == undefined) { // показываем список героев
            isRadiant = false;
            elemHeroesIcons.style.display='flex';
        }
        else if (!isRadiant) { // скрываем список героев
            isRadiant = undefined;
            elemHeroesIcons.style.display='none';
        }
        else isRadiant = false;
    }
});
// this - только что выбранный герой, heroes - массив выбранных до этого момента героев,
// hero - один из героев из массива heroes
function isPickedHero(hero, index, heroes) {
    if (hero == undefined) return false;
    return (hero.children()[0].name == this.children()[0].name);
}
$("img.checkableHero").imgCheckbox({ "graySelected": false, "scaleSelected": false,
onclick: function(selectedHero) {
    let name = selectedHero.children()[0].name;
    if (isRadiant) {
        // если решили отменить выбор какого-то героя
        let index = radiantHeroes.findIndex(isPickedHero, selectedHero);
        if (index != -1)
        {
            let hero = document.getElementById(`h${index+1}`);
            hero.name = 'null';
            hero.src = './assets/heroes/placeholder.png';
            radiantHeroes[index] = undefined;
        } // выбрали еще одного героя
        else {
            for (let i = 0; i < 5; ++i) {
                if (radiantHeroes[i] == undefined) {
                    //// если выбрали героя dire
                    let index = direHeroes.findIndex(isPickedHero, selectedHero);
                    if (index != -1) {
                        let hero = document.getElementById(`h${index+6}`);
                        hero.name = 'null';
                        hero.src = './assets/heroes/placeholder.png';
                        direHeroes[index] = undefined;
                    }
                    ////
                    let hero = document.getElementById(`h${i+1}`);
                    hero.name = name;
                    hero.src = `./assets/heroes/${name}.png`;
                    radiantHeroes[i] = selectedHero;
                    for (let i = 0; i < 5; ++i) {
                        if (radiantHeroes[i] == undefined)
                            return;
                    }
                    // выбрали 5-го героя?
                    isRadiant = undefined;
                    elemHeroesIcons.style.display = 'none';
                    return;
                }
            }
            // иначе 5 героев уже выбраны
            selectedHero.deselect();
        }
    } // dire-heroes
    else {
        // если решили отменить выбор какого-то героя
        let index = direHeroes.findIndex(isPickedHero, selectedHero);
        if (index != -1)
        {
            let hero = document.getElementById(`h${index+6}`);
            hero.name = 'null';
            hero.src = './assets/heroes/placeholder.png';
            direHeroes[index] = undefined;
        } // выбрали еще одного героя
        else {
            for (let i = 0; i < 5; ++i) {
                if (direHeroes[i] == undefined) {
                    //// если выбрали героя radiant
                    let index = radiantHeroes.findIndex(isPickedHero, selectedHero);
                    if (index != -1) {
                        let hero = document.getElementById(`h${index+1}`);
                        hero.name = 'null';
                        hero.src = './assets/heroes/placeholder.png';
                        radiantHeroes[index] = undefined;
                    }
                    ////
                    let hero = document.getElementById(`h${i+6}`);
                    hero.name = name;
                    hero.src = `./assets/heroes/${name}.png`;
                    direHeroes[i] = selectedHero;
                    for (let i = 0; i < 5; ++i) {
                        if (direHeroes[i] == undefined)
                            return;
                    }
                    // выбрали 5-го героя?
                    isRadiant = undefined;
                    elemHeroesIcons.style.display = 'none';
                    return;
                }
            }
            // иначе 5 героев уже выбраны
            selectedHero.deselect();
        }
    }
}});