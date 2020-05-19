const buttons = document.querySelectorAll('.response__choice')
const nextQuestion = document.querySelector('.next__question')
let buttonClickable = true

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
                    console.log('win')

                    win()
                }
                gamesCount()
            }
            buttonClickable = false
            nextQuestion.style.display = 'block'
        }) 
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
    if(score > 10)
    {
        console.log('winGame')
    }
    else
    {
        localStorage.setItem('score', score)
    }

    console.log(localStorage.getItem('score'))
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
        if(localStorage.score == 10)
        {
            console.log('winwinwinwin')
            // winGame()

        }
        else
        {
            console.log('you lose')
            //loose
        }
        localStorage.clear()
    }
    else
    {
        localStorage.setItem('gameCount', gameCount)
    }
}

clickButton()
