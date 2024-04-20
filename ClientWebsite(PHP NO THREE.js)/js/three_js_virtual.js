let scene, camera, renderer, controls;
let model;

function init() {
  scene = new THREE.Scene();
  scene.background = new THREE.Color(0x808080);

  camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
  camera.position.set(0, 0, 5);

  renderer = new THREE.WebGLRenderer({ antialias: true });
  renderer.setSize(window.innerWidth, window.innerHeight);
  renderer.toneMapping = THREE.ACESFilmicToneMapping;
  renderer.toneMappingExposure = 1.0;
  renderer.shadowMap.enabled = true;

  const container = document.getElementById('threejs-container');
  container.appendChild(renderer.domElement);

  controls = new THREE.PointerLockControls(camera, renderer.domElement);
  container.addEventListener('click', () => {
    controls.lock();
  });

  const loader = new THREE.GLTFLoader();
  loader.load('3Dmodel/Virtual Gallery1.0.glb', function (gltf) {
    model = gltf.scene;
    model.position.set(0, 0, 5);
    model.scale.set(1, 1, 1);
    model.rotation.set(0, 0, 0);

    model.traverse(function (child) {
      if (child.isMesh) {
        child.castShadow = true;
        child.receiveShadow = true;
        if (child.material.map) {
          child.material.map.anisotropy = 16;
        }
      }
    });

    scene.add(model);
    animate();
  }, undefined, function (error) {
    console.error('Error loading model:', error);
  });
}

const moveSpeed = 0.05;
const keys = { 'w': false, 'a': false, 's': false, 'd': false, 'space': false, 'shift': false };

document.addEventListener('keydown', (event) => {
  switch (event.code) {
    case 'KeyW': keys['w'] = true; break;
    case 'KeyA': keys['a'] = true; break;
    case 'KeyS': keys['s'] = true; break;
    case 'KeyD': keys['d'] = true; break;
    case 'Space': event.preventDefault(); keys['space'] = true; break;
    case 'ShiftLeft':
    case 'ShiftRight': keys['shift'] = true; break;
  }
});

document.addEventListener('keyup', (event) => {
  switch (event.code) {
    case 'KeyW': keys['w'] = false; break;
    case 'KeyA': keys['a'] = false; break;
    case 'KeyS': keys['s'] = false; break;
    case 'KeyD': keys['d'] = false; break;
    case 'Space': keys['space'] = false; break;
    case 'ShiftLeft':
    case 'ShiftRight': keys['shift'] = false; break;
  }
});

function animate() {
  requestAnimationFrame(animate);

  if (keys['w']) controls.moveForward(moveSpeed);
  if (keys['s']) controls.moveForward(-moveSpeed);
  if (keys['a']) controls.moveRight(-moveSpeed);
  if (keys['d']) controls.moveRight(moveSpeed);

  if (keys['space']) camera.position.y += moveSpeed;
  if (keys['shift']) camera.position.y -= moveSpeed;

  renderer.render(scene, camera);
}

init();
