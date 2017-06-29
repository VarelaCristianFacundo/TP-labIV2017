import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MenuencargadoComponent } from './menuencargado.component';

describe('MenuencargadoComponent', () => {
  let component: MenuencargadoComponent;
  let fixture: ComponentFixture<MenuencargadoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MenuencargadoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MenuencargadoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
