<div class="loading-screen" id="loadingScreen">
    <div class="word">
        <span>L</span>
        <span>O</span>
        <span>A</span>
        <span>D</span>
        <span>I</span>
        <span>N</span>
        <span>G</span>
        <span>.</span>
        <span>.</span>
    </div>
</div>
<style>
    .loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
    color: #9d9e9f;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    transition: opacity 0.5s ease-out;
}

.loading-screen.hidden {
    opacity: 0;
    visibility: hidden;
}

.word {
    font-family: 'Anton', sans-serif;
    perspective: 1000px;
}

.word span {
    display: inline-block;
    font-size: 60px;
    font-weight: bolder;
    user-select: none;
    line-height: .8;
}

.word span:nth-child(1).active {
    animation: balance 1.5s ease-out;
    transform-origin: bottom left;
}

@keyframes balance {
    0%, 100% {
        transform: rotate(0deg);
    }
    30%, 60% {
        transform: rotate(-45deg);
    }
}

.word span:nth-child(2).active {
    animation: shrinkjump 1s ease-in-out;
    transform-origin: bottom center;
}

@keyframes shrinkjump {
    10%, 35% {
        transform: scale(2, .2);
    }
    45%, 50% {
        transform: scale(1) translate(0, -150px);
    }
}

.word span:nth-child(3).active {
    animation: falling 2s ease-out;
    transform-origin: bottom center;
}

@keyframes falling {
    12% {
        transform: rotateX(240deg);
    }
    60%, 85% {
        transform: rotateX(180deg);
    }
}

.word span:nth-child(4).active {
    animation: rotate 1s ease-out;
}

@keyframes rotate {
    20%, 80% {
        transform: rotateY(180deg);
    }
    100% {
        transform: rotateY(360deg);
    }
}

.word span:nth-child(5).active {
    animation: toplong 1.5s linear;
}

@keyframes toplong {
    10%, 40% {
        transform: translateY(-48vh);
    }
    90% {
        transform: translateY(-48vh) scaleY(4);
    }
}

</style>

