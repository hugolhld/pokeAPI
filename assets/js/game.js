const buttons = document.querySelectorAll('.response__choice')
const nextQuestion = document.querySelector('.game__next__question')
let buttonClickable = true

const init = () =>
{
    if(parseInt(localStorage.getItem('gameCount')) > 8)
    {
        easterEgg()
    }

    setScoreDiv()
    clickButton()
}

const clickButton = () =>
{
    for(let i = 0; i < buttons.length; i++)
    {
        buttons[i].addEventListener('click', () =>
        {
            if(buttonClickable == true)
            {
                for(button of buttons)
                {
                    button.style.background = 'red'

                    if(button.getAttribute('data-result') == 1)
                    {
                        button.style.background = 'green'
                    }
                }

                if(buttons[i].getAttribute('data-result') == 1)
                {
                    win()
                }
                gamesCount()
            }
            buttonClickable = false
            nextQuestion.style.display = 'block'
        })

        if(buttons[i].getAttribute('data-result') == 1)
        {
            window.addEventListener('keypress', cheatcode(buttons[i]))
        }
    }
}

const win = () =>
{
    if(localStorage.getItem('score') === null)
    {
        localStorage.setItem('score', 0)
    }

    let score = localStorage.getItem('score')
    score = parseInt(score)
    score += 1

    if(score < 10)
    {
        localStorage.setItem('score', score)
    }
}

const winGame = (div) =>
{
    nextQuestion.innerText = 'Recommencer'
}

const gamesCount = () =>
{
    if(localStorage.getItem('gameCount') === null)
    {
        localStorage.setItem('gameCount', 0)
    }

    let gameCount = localStorage.getItem('gameCount')
    gameCount = parseInt(gameCount)
    gameCount += 1

    if(gameCount === 10)
    {
        console.log('end')
        if(localStorage.score > 7)
        {
            document.querySelector('.win__div').style.display = 'block'

        }
        else
        {
            document.querySelector('.loose__div').style.display = 'block'
            //loose
        }
        localStorage.clear()
    }
    else
    {
        localStorage.setItem('gameCount', gameCount)
    }
}

const setScoreDiv = () =>
{
    const gameCountDiv = document.querySelector('.score__game h5 span')
    gameCountDiv.innerText = localStorage.getItem('gameCount') ? parseInt(localStorage.getItem('gameCount')) + 1 : '1'

    const scoreCountDiv = document.querySelector('.score__player h5 span')
    scoreCountDiv.innerText = localStorage.getItem('score') ? localStorage.getItem('score') : '0'
}


const cheatcode = (button) =>
{
    const resultName = button.innerText

    let index = 0

    const gameNameDiv = document.querySelector('.game__name')
    const divCheat = document.createElement('h1')
    gameNameDiv.appendChild(divCheat)

    window.addEventListener('keypress', (_event) =>
    {
        if(_event.key == 'b')
        {
            divCheat.innerText += resultName.charAt(index)
            index += 1
        }
    })
}

const easterEgg = () =>
{
    buttons[0].innerText = 'Bruno'
    buttons[0].setAttribute('data-result', '0')
    buttons[1].innerText = 'Sudo'
    buttons[1].setAttribute('data-result', '1')
    document.querySelector('img').setAttribute('src', './assets/images/sudo.jpg')
}

init()